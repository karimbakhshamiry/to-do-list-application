<?php
  include './controller/core_functions.php';
  include './controller/db_connection.php';
  if (isset($_SESSION['authenticated'])) {
    header('location: index.php');
  }
  if (isset($_POST['login'])) {
    $user = [
      'username' => $_POST['username'],
      'password' => sha1($_POST['password'])
    ];

    $message = login($user['username'], $user['password']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>
<body>
<main class="main">
    <div class="container main__container">
      <form action="" method="POST" class="login-form">
        <h2 class="title">Login</h2>
        <div class="form-part">
          <label for="username">Email</label>
          <input type="email" name="username" id="username" placeholder="Email" required value="<?php echo $_POST['username'] ?>";>
        </div>

        <div class="form-part">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Password" minlength="8" required value="<?php echo $_POST['password'] ?>";>
        </div>
        <?php if ($message) {echo "<p class='alert alert-warning'>'$message'</p>";}?>

        <button class="btn btn-primary" type="submit" name="login">Login</button>
        <p class="sub-links">Dont have an account? Click <a href="register.php">here</a></p>
      </form>
    </div>
  </main>
</body>
</html>