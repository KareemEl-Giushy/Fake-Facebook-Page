<?php
  $server   = 'localhost';
  $db_name  = 'facebookadmin';
  $db_user  = 'root';
  $db_pass  = '';
  $attr = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ];

  try {
    $con = new PDO("mysql:host=$server;dbname=$db_name", $db_user, $db_pass, $attr);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (PDOException $e) {
    echo 'Faild to connect:- ' . $e->getmessage();
  }
