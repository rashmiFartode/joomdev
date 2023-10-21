<?php
session_start();
if (!isset($_SESSION['user'])) {
      // Redirect to the login page or any other page you prefer
      header('Location: index.php');
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
      <title>Add Employee</title>
</head>

<body>
      <?php include('navbar.php') ?>
      <section>
            <div class="container">
                  <div class="row">
                        <div class="col-12">
                              <h3 class="m-3">Add Employee</h3><br />
                              <?php
                              $sql = "SELECT * FROM jd_employees where role = 'employee'";
                              $result = $conn->query($sql);
                              if (mysqli_num_rows($result) > 0) {

                                    echo  '<table class="table">
                                          <thead>
                                                <tr>
                                                      <th scope="col">#</th>
                                                      <th scope="col">First name</th>
                                                      <th scope="col">Last name</th>
                                                      <th scope="col">Email</th>
                                                      <th scope="col">Phone number</th>   
                                                      <th scope="col">Added on</th>
                                                </tr>
                                          </thead>
                                          <tbody>';

                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                          echo '<tr>';
                                          echo "<td>" . $row['id'] . "</td>";
                                          echo "<td>" . $row['first_name'] . "</td>";
                                          echo "<td>" . $row['last_name'] . "</td>";
                                          echo "<td>" . $row['email'] . "</td>";
                                          echo "<td>" . $row['phone'] . "</td>";
                                          echo "<td>" . $row['created_at'] . "</td>";
                                          echo "</tr>";
                                    }

                                    echo '</tbody> </table>';
                              } else {
                                    echo "<h3>No entries yet...</h3>";
                              }
                              ?>
                        </div>
                  </div>
            </div>
      </section>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>