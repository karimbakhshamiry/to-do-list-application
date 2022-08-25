<?php
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'note';

  $connection = mysqli_connect($host, $user, $password, $database);
  if (!$connection) {
    die('there is a problem connecting to the database');
  }
?>