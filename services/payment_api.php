<?php

use App\DB;
use Mpdf\Mpdf;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

$con = DB::get_connection();

try {
    $source = file_get_contents('php://input');
    $data = json_decode($source, true);

    $factory = new \YooKassa\Model\Notification\NotificationFactory();
    $notificationObject = $factory->factory($data);
    $responseObject = $notificationObject->getObject();

    $client = new \YooKassa\Client();

    if (!$client->isNotificationIPTrusted($_SERVER['REMOTE_ADDR']))
    {
        header('HTTP/1.1 400 Something went wrong');
        exit();
    }

    $payment_statuses = [
        \YooKassa\Model\NotificationEventType::PAYMENT_SUCCEEDED,
        \YooKassa\Model\NotificationEventType::PAYMENT_WAITING_FOR_CAPTURE,
        \YooKassa\Model\NotificationEventType::PAYMENT_CANCELED
    ];

    if ( in_array( $notificationObject->getEvent(), $payment_statuses ) )
    {
        $id = $responseObject->getId();
        $status = $responseObject->getStatus();

        // update order status

        $query = $con->prepare('UPDATE orders set status=:status WHERE payment_id=:payment_id');
        $query->execute([ 'status' => $status, 'payment_id' => $id ]);

        // if order succeeded 
        // get tickets for user

        if ( $status == 'succeeded' )
        {
            $query = $con->prepare('SELECT * FROM orders WHERE payment_id=:payment_id LIMIT 1');
            $query->execute([ 'payment_id' => $id ]);
            $res = $query->fetchAll()[0];

            $orderId = $res['id'];
            $orderQuantity = $res['quantity'];
            $orderEmail = $res['email'];

            $query = $con->prepare('UPDATE tickets SET order_id=:order_id WHERE order_id IS NULL LIMIT :quantity');
            $query->execute([ 'order_id' => $orderId, 'quantity' => $orderQuantity ]);

            // generate mail

            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.beget.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'no-reply@vlvt.ru';                     // SMTP username
            $mail->Password   = 'Rbhjdf4747!';                          // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port       = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom('no-reply@vlvt.ru', 'vlvt.ru');
            $mail->addAddress($orderEmail);

            $mail->isHTML(true);
            $mail->Subject = 'vlvt.ru — Заказ №' . $orderId;
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // generate tickets pdfs

            $query = $con->prepare('SELECT * FROM tickets WHERE order_id=:order_id');
            $query->execute([ 'order_id' => $orderId ]);
            $tickets = $query->fetchAll();

            for ( $i = 0; $i < count($tickets); $i++ )
            {
                $ticket = $tickets[$i];

                $mpdf = new Mpdf([ 'orientation' => 'L' ]);
                $mpdf->showImageErrors = true;
        
                $mpdf->WriteHTML('
                  <div style="position: absolute; top: 0; left: 0; width: 220mm;">
                    <img width="100%" height="100%" src="images/ticket.jpeg">
                  </div>
              
                  <div style="position: absolute; top: 16mm; left: 230mm; font-size: 8mm; font-weight: bold; font-family: monospace; letter-spacing: 0.5mm;">
                    Билет #' . $ticket['id'] . '
                  </div>
              
                  <div style="position: absolute; bottom: 13mm; left: 224mm; width: 60mm; height: 60mm;">
                    <img 
                        width="100%" 
                        height="100%" 
                        src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://vlvt.ru/admin/tickets/' . $ticket['id'] . '"
                    >
                  </div>
                ');
                $pdfContent = $mpdf->Output('', 'S');

                $mail->addStringAttachment($pdfContent, $i+1 . '-билет.pdf', PHPMailer::ENCODING_BASE64, 'application/pdf');
            }

            // send mail

            $mail->send();
        }
    }

} catch (Exception $e) {
    header('HTTP/1.1 400 Something went wrong');
    exit();
}
