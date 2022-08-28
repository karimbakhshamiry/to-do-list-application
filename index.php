<?php
  include './controller/core_functions.php';
  handleNotAuthenticated();

  if (isset($_POST['addTask'])) {
    $message = addNewTask($_POST['category'], $_POST['newTask'], $_SESSION['user']['userName']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Home</title>
</head>
<body>
  <main class="main">
    <div class="profile">
      <?php
        $profilePic = $_SESSION['user']['avatar'] != null ? $_SESSION['user']['avatar'] : 'default_avatar.png'; 
        echo "
          <a href='profileSetting.php?name=".$_SESSION['user']['name']."&lastname=".$_SESSION['user']['lastName']."'><img class='profile-picture' src='./images/$profilePic' alt='profile'></a>
          <p class='username'>".$_SESSION['user']['userName']."</p>
        ";
      ?>
    </div>
    <div class="container main__container">
      <div class="add-task">
        <form action="" method="post" class="task-form">
          <h2 class="title">Add new task</h2>
          <div class="form-part">
            <label for="category">Category</label>
            <!-- <div> -->
            <input list="categories" name="category" id="category" placeholder="category" value = "all" autocomplete="off" required>
            <datalist id="categories">
              <?php
              foreach (explode(",", $_SESSION['user']['categories']) as $category) {
                echo "<option value='$category'>$category</option>";
              }
              ?>
            </datalist>
            <!-- </div> -->
          </div>

          <div class="form-part">
            <label for="newTask">New Task</label>
            <input type="text" name="newTask" id="newTask" required>
          </div>

          <button type="submit" name="addTask" class="btn btn-primary">Add task</button>
          <?php if ($message) {echo "<p class='alert alert-success'>$message</p>";} ?>
        </form>
      </div>

      <div class="all-tasks">
        <?php
          $username = $_SESSION['user']['userName'];
          $sql = "SELECT id, task, completed FROM tasks WHERE userName='$username' ORDER BY id DESC";
          $result = $GLOBALS['db']->query($sql);
          $tasks = $result->fetch_all(MYSQLI_ASSOC);
          echo "
            <div class='category all'>
            <div class='title-container'>
              <h2 class='title'>All</h2>
              <svg data-category='all' class='removeCategory' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z'/></svg>
            </div>
              <div class='tasks'>
          ";
            foreach ($tasks as $task) {
              $checked = $task['completed'] ? 'checked' : '';
              echo "
                <div class='task'>
                  <input type='checkbox' data-completed=".$task['completed']." data-id=".$task['id']." class='checkCompleted' $checked> <p>".$task['task']."</p> 
                  <svg data-id=".$task['id']." class='remove' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z'/></svg>
                </div>
              ";
            }
          echo "
              </div>
            </div>
          ";

          foreach(explode(",", $_SESSION['user']['categories']) as $category) {
            if ($category != 'all') {
              $sql = "SELECT id, task, completed FROM tasks WHERE userName='$username' AND category='$category' ORDER BY id DESC";
              $result = $GLOBALS['db']->query($sql);
              $tasks = $result->fetch_all(MYSQLI_ASSOC);
              echo "
                <div class='category $category'>
                <div class='title-container'>
                  <h2 class='title'>$category</h2>
                  <svg data-category='$category' class='removeCategory' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z'/></svg>
                </div>
                  <div class='tasks'>
              ";
                foreach ($tasks as $task) {
                  $checked = $task['completed'] ? 'checked' : '';
                  echo "
                    <div class='task'>
                      <input type='checkbox' data-completed=".$task['completed']." data-id=".$task['id']." class='checkCompleted' $checked> <p>".$task['task']."</p> 
                      <svg data-id=".$task['id']." class='remove' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z'/></svg>
                    </div>
                  ";
                }
              echo "
                  </div>
                </div>
              ";
            }
          }
        ?>
      </div>
    </div>
  </main>
  <script src="index.js"></script>
</body>
</html>