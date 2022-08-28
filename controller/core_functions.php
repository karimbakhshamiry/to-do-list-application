<?php
  include 'db_connection.php';
  $GLOBALS['db'] = $connection;
  session_start();

  function handleNotAuthenticated() {
    if (!isset($_SESSION['authenticated'])) {
      header("location: login.php");
    }
  }

  function login($username, $password) {

    $sql = "SELECT id, name, lastName, userName, avatar, categories FROM users WHERE userName='$username' AND password='$password'";
    $result = $GLOBALS['db']->query($sql);
    $userDetails = $result->fetch_assoc();
    if ($userDetails) {
      $_SESSION['authenticated'] = true;
      $_SESSION['user'] = $userDetails;
      header('location: index.php');
      var_dump($_SESSION['authenticated']);
      return;
    } else {
      return 'wrong credentials, try again!';
    }
  }

  function register_user($name, $lastname, $username, $password) {
    if ($GLOBALS['db']->query("SELECT username FROM users WHERE username='$username'")->fetch_assoc()) {
      return 'This username is already in use, please enter another username';
    }

    $sql = "INSERT INTO users (name, lastName, userName, password) value('$name', '$lastname', '$username', '$password')";
    echo $sql;
    $GLOBALS['db']->query($sql);
    header('location: login.php');
    return;
  } 

  function logout() {
    session_destroy();
    header('location: login.php');
  }

  function addNewTask($category, $task, $username) {
    $categories = $_SESSION['user']['categories'];
    if (!in_array($category, explode(',', $categories))) {
      $sql = "UPDATE users SET categories='$categories,$category' WHERE username='$username'";
      $GLOBALS['db']->query($sql);

      $sql = "SELECT categories FROM users WHERE userName = '$username'";
      $result = $GLOBALS['db']->query($sql);
      $data = $result->fetch_assoc();
      $_SESSION['user']['categories'] = $data['categories'];
    }
    $sql = "INSERT INTO tasks (category, task, username) value('$category', '$task', '$username')";
    $GLOBALS['db']->query($sql);
    return 'successfully added';
  }

  function updateProfileInfo($name, $lastname, $image = null) {
    if ($image != null) {
      if ($image['type'] != 'image/jpeg' && $image['type'] && 'image/jpg' && $image['type'] != 'image/png') {
        return 'image type must be jpeg, jpg or png';
      }
    }
    echo var_dump($image);
    $username = $_SESSION['user']['userName'];
    if (strlen($image['name']) > 0) {
      $extension = end(explode('.', $image['name']));
      $imageName = sha1($image['name'].$_SESSION['user']['userName']).'.'.$extension;
      move_uploaded_file($image['tmp_name'], './images/'.$imageName);
      $sql = "UPDATE users SET name='$name', lastName='$lastname', avatar='$imageName' WHERE userName='$username'";
      $GLOBALS['db']->query($sql);
      $_SESSION['user']['avatar'] = $imageName;
    } else {
      $sql = "UPDATE users SET name='$name', lastName='$lastname' WHERE userName='$username'";
      $GLOBALS['db']->query($sql);
    }

    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['lastName'] = $lastname;
    header('location: index.php');

  }
?>