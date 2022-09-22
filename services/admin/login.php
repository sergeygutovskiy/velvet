<?php

// 

$name = $_POST['name'];
$password = $_POST['password'];

// 

if ( $name === $_ENV['ADMIN_USER'] && $password === $_ENV['ADMIN_PASSWORD'] )
{
  $_SESSION['is_admin'] = true;

  header('Location: /');
  return;
} else
{
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  return;
}
