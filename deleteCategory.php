<?php
  include './controller/core_functions.php';
  $category = $_GET['category'];
  $username = $_SESSION['user']['userName'];

  if ($category == 'all') {
    $sql = "DELETE FROM tasks WHERE userName='$username'";
    $GLOBALS['db']->query($sql);
  } else {
    $categories = explode(',', $_SESSION['user']['categories']);
    
    if (($key = array_search($category, $categories)) != false) {
      unset($categories[$key]);
    }
    
    $categories = implode(',', $categories);
    $deleteSql = "DELETE FROM tasks WHERE category='$category'";
    $updateSql = "UPDATE users SET categories='$categories' WHERE userName='$username'"; 
    if ($_SESSION['authenticated']) {
      $GLOBALS['db']->query($deleteSql);
      $GLOBALS['db']->query($updateSql);
      $_SESSION['user']['categories'] = $categories;
    } else {
      echo 'you are not an authorized individual to perform this action!';
    }
  }
?>