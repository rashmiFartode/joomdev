<?php
session_start();
if (!isset($_SESSION['user'])) {
      // Redirect to the login page or any other page you prefer
      header('Location: index.php');
      exit; // Stop further script execution
}
include_once('dbconnection.php');
if (isset($_POST['submit'])) {
      $sql = "SELECT * FROM jd_tasks";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
            $delimiter = ",";
            $filename = "tasks-data_" . date('Y-m-d') . ".csv";
            // Create a file pointer 
            $f = fopen('php://memory', 'w');
            $fields = array('Start time', 'Stop Time', 'Notes', 'Description');
            fputcsv($f, $fields, $delimiter);

            while ($row = $result->fetch_assoc()) {
                  $lineData = array($row['start_time'], $row['stop_time'], $row['notes'], $row['description']);
                  fputcsv($f, $lineData, $delimiter);
            }

            // Move back to beginning of file 
            fseek($f, 0);

            // Set headers to download file rather than displayed 
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            //output all remaining data on a file pointer 
            fpassthru($f);
      }
      exit;
}
