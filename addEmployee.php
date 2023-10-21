<?php
session_start();
if (!isset($_SESSION['user'])) {
      // Redirect to the login page or any other page you prefer
      header('Location: index.php');
      exit; // Stop further script execution
}
include_once('dbconnection.php');

function test_input($data)
{

      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}

function hashpassword($password)
{
      $options = [
            'cost' => 12,
      ];
      $hash = password_hash($password, PASSWORD_BCRYPT, $options);
      return $hash;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // print_r($_POST); exit;
      // Prepare and bind the SQL statement
      $sql = "INSERT INTO jd_employees (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);

      // Bind parameters
      $stmt->bind_param('sssss', $first_name, $last_name, $email, $phone_number, $encpass);
      $first_name   = test_input($_POST["first_name"]);
      $last_name    = test_input($_POST["last_name"]);
      $email        = test_input($_POST["email"]);
      $phone_number = test_input($_POST["phone_number"]);
      if (isset($_POST['autogenerate'])) {
            /* $chars    = $first_name . $last_name . $phone_number . "!@#$%&*_";
            $password = substr(str_shuffle($chars), 0, 8); */
            $encpass  = hashpassword($phone_number);
      } else {
            $encpass = "";
      }
      $result = $stmt->execute();

      if ($stmt) {

            $_SESSION['message'] = "Employee added.";
            header("location: adminpage.php");
            exit();
      } else {
            $_SESSION['message'] = "Failed! Please try again.";
            header("location: adminpage.php");
            die();
            // echo "Error: " . $sql . "<br>" . $conn->error;
      }
}
