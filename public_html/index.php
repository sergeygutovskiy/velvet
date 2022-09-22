<?php

use Dotenv\Dotenv;

session_start();

require '../vendor/autoload.php';
require '../services/db.php';

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ( $requestMethod === 'GET' )
{
    switch ( $url )
    {
        case '':
        case '/': require '../pages/index.php'; break;

        case '/contacts': require '../pages/contacts.php'; break;
        case '/order': require '../pages/order.php'; break;

        case '/admin/login': require '../pages/admin/login.php'; break;
  }
} else if ( $requestMethod === 'POST' )
{
    switch ( $url )
    {
        case '/create-order': require '../services/create_order.php'; break;
        case '/api/ba0d96b6e9f090b8064580010169390aaefea5ba/order/notificate': require '../services/payment_api.php'; break;
        case '/admin/login': require '../services/admin/login.php'; break;
    }
}
