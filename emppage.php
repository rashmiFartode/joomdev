<?php
session_start();
if (!isset($_SESSION['user'])) {
      // Redirect to the login page or any other page you prefer
      header('Location: index.php');
      exit; // Stop further script execution
}
if ($_SESSION['user']['pwd_expired'] == 1) {
      header('Location: change_password.php');
      exit; // Stop further script execution
}
include_once('dbconnection.php');
// print_r($_SESSION['user']['name']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="styles/login.css">
      <title>Add Task</title>
</head>

<body>
      <?php include('navbar.php') ?>
      <section>
            <div class="container">
                  <div class="row">
                        <div class="col-8 align-self-center">
                              <?php
                              if (isset($_SESSION['message'])) {
                                    echo '<div class="text-danger">' . $_SESSION['message'] . '</div>';
                                    unset($_SESSION['message']);
                              }
                              ?>
                              <form action="addtask.php" method="post">
                                    <div class="">
                                          <h1>Add Task</h1>

                                          <div class="textbox">
                                                <input type="text" placeholder="Title" name="title" value="" required>
                                          </div>

                                          <div class="textbox">
                                                <input type="datetime-local" placeholder="Start Time" name="start_time" value="" required>
                                          </div>

                                          <div class="textbox">
                                                <input type="datetime-local" placeholder="Stop Time" name="stop_time" value="" required>
                                          </div>

                                          <div class="textbox">
                                                <input type="text" placeholder="Notes" class="form-control" name="notes" value="" required>
                                          </div>

                                          <div class="textbox">
                                                <textarea placeholder="Description" name="description" required rows="5" cols="70"></textarea>
                                          </div>

                                          <input class="btn btn-success mt-3" type="submit" name="submit" value="Submit">
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </section>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>