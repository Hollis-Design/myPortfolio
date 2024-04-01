<?php

/* 
 * Database connections
 */

function acmeConnect()
{
    $server = 'localhost';
    $database = 'acme';
    $username = 'iClient';
    $password = 'LNgz2RStyqqHQ9A1';
    $dsn = 'mysql:host='.$server.'; dbname='.$database;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
      $acmelink = new PDO($dsn, $username, $password, $options);
      //echo'$acmeLink worked successfully<br>';
      return $acmelink;
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      header('Location: /acme/view/500.php');
      exit;
    }
}

