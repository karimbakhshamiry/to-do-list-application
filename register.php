<?php

  include './controller/core_functions.php';
  if ($_SESSION['authenticated']) {
    header('location: index.php');
  }

  if (isset($_POST['register'])) {
    if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password'])) {
      $user = [
        'name' => $_POST['name'],
        'lastname' => $_POST['lastname'],
        'username' => $_POST['username'],
        'password' => sha1($_POST['password'])
      ];
      $message = register_user($user['name'], $user['lastname'], $user['username'], $user['password']);
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Sign up</title>
</head>
<body>
  <main class="main">
    <div class="container main__container">
      <form action="" method="POST" class="register-form">
        <h2 class="title">Sign Up</h2>
        <div class="form-part">
          <label for="name">First Name</label>
          <input type="text" name="name" id="name" placeholder="First Name" required value="<?php echo $_POST['name'] ?>";>
        </div>
        <div class="form-part">
          <label for="lastname">Last Name</label>
          <input type="text" name="lastname" id="lastname" placeholder="Last Name" required value="<?php echo $_POST['lastname'] ?>";>
        </div>

        <div class="form-part">
          <label for="username">Email</label>
          <input type="email" name="username" id="username" placeholder="Email" required value="<?php echo $_POST['username'] ?>";>
        </div>

        <div class="form-part">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Password" minlength="8" required value="<?php echo $_POST['password'] ?>";>
        </div>
        <?php if ($message) {echo "<p class='alert alert-warning'>'$message'</p>";}?>

        <button class="btn btn-primary" type="submit" name="register">Sign Up</button>
        <p class="sub-links">Already have an account? Click <a href="login.php">here</a></p>
      </form>
    </div>
  </main>
</body>
</html>