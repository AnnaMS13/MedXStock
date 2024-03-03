<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "shop"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $medicine_name = $_POST['medicine_name'];
  $pin_code = $_POST['pin_code'];

  // Insert new row into customer_requests table
  $sql_insert = "INSERT INTO medicine_table (medicine_name, pin_code, status1) VALUES ('$medicine_name', '$pin_code', 'Pending')";
  if ($conn->query($sql_insert) === TRUE) {
    echo "Request submitted successfully";
  } else {
    echo "Error inserting record: " . $conn->error;
  }
}

// Close connection
$conn->close();
?>
