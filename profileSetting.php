<?php
  include './controller/core_functions.php';

  handleNotAuthenticated();
  // echo isset($_FILES['newProfile']);
  if (isset($_POST['saveChanges'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $image = $_FILES['newProfile'];
    if (isset($_FILES['newProfile'])) {
      $message = updateProfileInfo($name, $lastname, $image);
    } else {
      $message = updateProfileInfo($name, $lastname);
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
  <title>Profile Setting</title>
</head>
<body>
  <main class="main">
    <div class="container main__container">
      <form action="#" class="setting-form" method="POST" enctype="multipart/form-data">
        <h2 class="title">Profile setting</h2>
        <div class="form-part">
          <label for="name">Name</label>
          <input type="text" name="name" id="name"value="<?php echo $_GET['name']?>" required/>
        </div>
        <div class="form-part">
          <label for="lastname">Last name</label>
          <input type="text" name="lastname" id="lastname" value="<?php echo $_GET['lastname']?>" required/>
        </div>
        <div class="form-part">
          <label for="newProfile">New Image</label>
          <input type="file" name="newProfile" id="newProfile">
          <!-- <input type="file" name="new_profile" id="new_profile"  required> -->
        </div>
        <button type="submit" class="btn btn-primary" name="saveChanges">Save Changes</button>
        <?php if ($message) { echo "<p class='alert alert-warning>$message</p>";} ?>
        
      </form>
    </div>
  </main>
</body>
</html>