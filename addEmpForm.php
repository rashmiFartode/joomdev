<?php
session_start();
if (!isset($_SESSION['user'])) {
      // Redirect to the login page or any other page you prefer
      header('Location: index.php');
      exit; // Stop further script execution
}

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
      <title>Add Employee</title>
</head>

<body>
      <?php include('navbar.php') ?>
      <div class="container">
            <div class="row">
                  <div class="col-8 align-self-center">
                        <?php
                        if (isset($_SESSION['message'])) {
                              // echo '<div class="text-danger">' . $_SESSION['message'] . '</div>';
                        }
                        ?>
                        <form action="addEmployee.php" method="post">
                              <div class="">
                                    <h1>Add Employee</h1>

                                    <div class="textbox">
                                          <input type="text" placeholder="First name" name="first_name" value="" required>
                                    </div>

                                    <div class="textbox">
                                          <input type="text" placeholder="Last name" name="last_name" value="" required>
                                    </div>

                                    <div class="textbox">
                                          <input type="email" placeholder="Email" name="email" value="" required>
                                    </div>

                                    <div class="textbox">
                                          <input type="text" placeholder="Phone number" name="phone_number" value="" required>
                                    </div>

                                    <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="autogenerate" name="autogenerate" checked readonly>
                                          <label class="form-check-label" for="autogenerate">
                                                Password (Auto generate)
                                          </label>
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