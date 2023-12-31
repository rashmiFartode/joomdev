<?php
session_start();
/* if (!isset($_SESSION['user'])) {
            // Redirect to the login page or any other page you prefer
            header('Location: login.php');
            exit; // Stop further script execution
      } */

?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="styles/login.css">
      <title>Login Page</title>
</head>

<body>

      <form action="validate.php" method="post">
            <div class="login-box">
                  <h1>Login</h1>
                  <?php
                        if (isset($_SESSION['err'])) {
                              echo '<p class="text-danger"' . $_SESSION['err'] . '</p>';
                        }
                  ?>
                  <div class="textbox">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" placeholder="Email" name="email" value="" required>
                  </div>

                  <div class="textbox">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" placeholder="Password" name="password" value="" required>
                  </div>

                  <input class="button" type="submit" name="login" value="Sign In">
            </div>
      </form>
</body>

</html>