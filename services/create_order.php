<?php

use YooKassa\Client;
use App\DB;

$fio = $_POST['fio'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$quantity = $_POST['quantity'];

// calc total price

$quantity = (int) $quantity;

$price = 0;
if ( $quantity >= (int) $_ENV['DISCOUNT_AMOUNT'] ) $price = (int) $_ENV['DISCOUNT_PRICE'] * $quantity;
else $price = (int) $_ENV['PRICE'] * $quantity;

// auth payment api

$client = new Client();
$client->setAuth($_ENV['UKASSA_ID'], $_ENV['UKASSA_KEY']);

// create order

$con = DB::get_connection();
$query = $con->prepare('INSERT INTO orders (fio, phone, email, total, quantity) values (:fio, :phone, :email, :total, :quantity)');
$query->execute([
    'fio' => $fio,
    'phone' => $phone,
    'email' => $email,
    'total' => $price,
    'quantity' => $quantity
]);

$orderId = $con->lastInsertId();

// create payment

$siteUrl =  ( isset($_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'];
$returnUrl = $siteUrl . '/order'; 

$payment = $client->createPayment(
    [
        'amount' => [
            'value' => $price,
            'currency' => 'RUB',
        ],
        'confirmation' => [
            'type' => 'redirect',
            'return_url' => $returnUrl
        ],
        'capture' => true,
        'description' => 'Заказ №' . $orderId,
        'metadata' => [
            'fio' => $fio,
            'email' => $email,
            'phone' => $phone,
            'order_id' => $orderId,
        ],
    ],
    uniqid('', true)
);

// update order payment id and status

$query = $con->prepare('UPDATE orders set payment_id=:payment_id, status=:status WHERE id=:id');
$query->execute([ 'payment_id' => $payment->getId(), 'status' => $payment->getStatus(), 'id' => $orderId ]);

// redirect user to payment form

$confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();
header('Location: ' . $confirmationUrl);
