<?php
  include './controller/core_functions.php';
  include './controller/db_connection.php';

  $connection->query("insert into users (name, lastName, userName, password) value('saboor', 'hakimi', 'saboor@gmail.com', 'password')");
?>