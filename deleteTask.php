<?php
  include './controller/core_functions.php';
  $id = $_GET['id'];
  $sql = "DELETE FROM tasks WHERE id=$id";
  if ($_SESSION['authenticated']) {
    $GLOBALS['db']->query($sql);
  } else {
    echo 'you are not an authorized individual to perform this action!';
  }
?>