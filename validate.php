<?php
session_start();
include_once('dbconnection.php');

function test_input($data)
{

      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $email    = test_input($_POST["email"]);
      $password = $_POST["password"];
      $result   = mysqli_query($conn, "SELECT * FROM jd_employees WHERE email='$email'LIMIT 1");
      // print_r(password_verify($password, $row['password']));
      if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // print_r($row); exit;
            // print_r($row);  
            if (password_verify($password, $row['password'])) {

                  $user = [
                        'id'          => $row['id'],
                        'name'        => $row['first_name'],
                        'role'        => $row['role'],
                        'pwd_expired' => 0
                  ];
                  $_SESSION['user'] = $user;
                  $_SESSION['loggedin'] = true;

                  if ($row['role'] == 'admin') {
                        header("location: adminpage.php");
                  } else {
                        $last_login = date("Y-m-d");

                        $sql = "UPDATE jd_employees SET  last_login = '$last_login' where id =" . $_SESSION['user']['id'];
                        $res = $conn->query($sql);

                        $last_password_change            = $row['last_password_change'];
                        $current_date                    = date("Y-m-d");
                        $datetime1                       = new DateTime($last_password_change);
                        $datetime2                       = new DateTime($current_date);
                        $interval                        = $datetime1->diff($datetime2);
                        $days_since_last_password_change = $interval->format('%a');

                        if ($last_password_change == null) {
                              $_SESSION['pwd_message'] =  "Your password has expired. Please update it for continued access.";
                              header("location: change_password.php");
                              exit();
                        } elseif ($days_since_last_password_change >= 30) {
                              $_SESSION['user']['pwd_expired'] = 1;
                              $_SESSION['pwd_message'] = "Your password has expired. Please update it for continued access.";
                              header("location: change_password.php");
                              exit();
                        }

                        header("location: emppage.php");
                  }
            } else {
                  $_SESSION['err'] = "Wrong password!";
                  header("location: index.php");
                  exit();
            }
      } else {
            $_SESSION['err'] = "Invalid username or password";
            header("location: index.php");
            echo "<script language='javascript'>";
            echo "alert('Invalid username or password')";
            echo "</script>";
            exit();
      }
}
