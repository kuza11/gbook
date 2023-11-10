<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
if (empty($name) || empty($message) || empty($email)) {
  ?>
  <!DOCTYPE html>
  <html lang="cs-cz">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>
    <h1>Nevyplnil jste všechny položky<br><a href="javascript:self.history.back();">ZPĚT</a></h1>
  </body>

  </html>
  <?php
  exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  ?>
  <!DOCTYPE html>
  <html lang="cs-cz">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>
    <h1>Špatná emailová adresa.<br><a href="javascript:self.history.back();">ZPĚT</a></h1>
  </body>

  </html>
  <?php
  exit;
}
include_once ('gbook.class.php');
$gbook = new gbook();



if($gbook->writePost($name, $email, $message, date('Y-m-d'), $_SERVER['REMOTE_ADDR'])) {
  

  header('Location: index.php?res=1');
}
else {
  header('Location: index.php?res=0');
}
?>