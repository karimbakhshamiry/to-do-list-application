<?php
  include './controller/core_functions.php';
  $id = $_GET['id'];
  $status = $_GET['status'] ? 0 : 1;
  $sql = "UPDATE tasks SET completed=$status WHERE id=$id";
  if ($_SESSION['authenticated']){
    $GLOBALS['db']->query($sql);
    header('location: http://localhost:8000/index.php');
  } else {
    echo 'you are not an authorized individual to perform this action!';
  }
?>