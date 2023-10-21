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

function test_input($data)
{

      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // print_r($_POST); exit;
      // Prepare and bind the SQL statement
      $sql = "INSERT INTO  jd_tasks (title, start_time, stop_time, notes, description, created_by) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);

      // Bind parameters
      $stmt->bind_param('ssssss', $title, $start_time, $stop_time, $notes, $description, $created_by);
      $title       = test_input($_POST["title"]);
      $start_time  = test_input($_POST["start_time"]);
      $stop_time   = test_input($_POST["stop_time"]);
      $notes       = test_input($_POST["notes"]);
      $description = test_input($_POST["description"]);
      $created_by  = $_SESSION['user']['id'];
      $result      = $stmt->execute();

      if ($result) {
            // $_SESSION['message'] = "Task added.";
            header("location: tasklist.php");
            exit();
      } else {
            $_SESSION['message'] = "Failed! Please try again.";
            header("location: emppage.php");
            // echo "Error: " . $sql . "<br>" . $conn->error;
            exit();
      }
}
