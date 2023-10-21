<?php
session_start();
if (!isset($_SESSION['user'])) {
      // Redirect to the login page or any other page you prefer
      header('Location: index.php');
      exit; // Stop further script execution
}
include_once('dbconnection.php');
// print_r($_SESSION);
function hashpassword($password)
{
      $options = [
            'cost' => 12,
      ];
      $hash = password_hash($password, PASSWORD_BCRYPT, $options);
      return $hash;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
      // print_r($_POST);
      // Prepare and bind the SQL statement
      $sql    = "SELECT * FROM  jd_employees where id = " . $_SESSION['user']['id'];
      $result = $conn->query($sql);
      if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
      }
      $currentPassword = $_POST['current_password'];
      $passworde       = $_POST['password'];
      $passwordConfirm = $_POST['confirm_password'];

      if ($passwordConfirm == '' || $passworde == '' || $currentPassword == '') {
            $errors[] = 'Please fill out all input.';
      }

      if (password_verify($currentPassword, $row['password'])) {
            if ($passwordConfirm == '') {
                  $errors[] = 'Please confirm the password.';
            } elseif ($passworde != $passwordConfirm) {
                  $errors[] = 'Confirm Passwords do not match.';
            } elseif (strlen($_POST['password']) < 7) { // min 
                  $errors[] = 'The password should be atleast 8 characters long.';
            } elseif (strlen($_POST['password']) > 20) { // Max 
                  $errors[] = 'Password: Max length 20 Characters are allowed';
            }

            if (!isset($errors)) {
                  $last_password_changed = date("Y-m-d");;
                  $hashpassword = hashpassword($passworde);
                  $sql = "UPDATE jd_employees SET  password = '$hashpassword', last_password_changed = '$last_password_changed' where id =" . $_SESSION['user']['id'];
                  $res = $conn->query($sql);
                  if ($res) {
                        $_SESSION['message'] = "Password changed.";
                        $_SESSION['user']['pwd_expired'] = 0;
                        header("location: tasklist.php");
                        exit();
                  } else {
                        /* $_SESSION['message'] = "Failed! Please try again.";
                        header("location: emppage.php"); */
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        // die();
                  }
            }
      } else {
            $errors[] = "Current password does not match.";
      }
      // print_r($errors);
}
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
      <title>Add Employee</title>
</head>

<body>
      <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                  <a class="navbar-brand" href="#">JoomDev</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                  </button>
                  <span class="text-end">Welcome, <?php echo $_SESSION['user']['name'] ?  ucfirst($_SESSION['user']['name']) : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <form action="logout_process.php" method="post" class="d-inline">
                              <button type="submit" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</button>
                        </form>
                  </span>
            </div>
            </div>
      </nav>
      <div class="container">
            <div class="row">
                  <div class="col-8 align-self-center">
                        <form action="" method="post">
                              <div class="">
                                    <h1>Change password</h1>

                                    <?php
                                    if (isset($errors)) {
                                          foreach ($errors as $error) {
                                                echo '<p class="text-danger">' . $error . "</p>";
                                          }
                                    }

                                    if (isset($_SESSION['pwd_message'])) {
                                          echo '<p class="text-danger">' . $_SESSION['pwd_message'] . '</p>';
                                    }
                                    ?>
                                    <div class="textbox">
                                          <input type="password" placeholder="Current Password" name="current_password" value="" required>
                                    </div>

                                    <div class="textbox">
                                          <input type="password" placeholder="New Password" name="password" value="" required>
                                    </div>

                                    <div class="textbox">
                                          <input type="password" placeholder="Confirm new password" name="confirm_password" value="" required>
                                    </div>

                                    <input class="btn btn-success mt-3" type="submit" name="submit" value="Submit">
                              </div>
                        </form>
                  </div>
            </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>