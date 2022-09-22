<?php

use Dotenv\Dotenv;

require '../vendor/autoload.php';
require '../services/db.php';

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

if ( $url === '/' || $url === '' ) {
  require '../pages/index.php';
  return;
} else if ( $url === '/contacts' ) {
  require '../pages/contacts.php';
  return;
} else if ( $url === '/order' ) {
  require '../pages/order.php';
  return;
} else if ( $url === '/create-order' ) {
  require '../services/create_order.php';
  return;
} else if ( $url === '/api/ba0d96b6e9f090b8064580010169390aaefea5ba/order/notificate' ) {
  require '../services/payment_api.php';
  return;
}
