<?php
include('configure/constants.php');
// Database connection settings
// $host = 'localhost';
// $dbUsername = 'root';
// $dbPassword = '';
// $dbName = 'task__manager';

// // Establishing connection
// $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// if ($conn->connect_error) {
//   die('Connection failed: ' . $conn->connect_error);
// }

// Dummy login validation
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $response = array('success' => true);
} else {
  $response = array('success' => false, 'message' => 'Invalid Username or Password!!');
}

$conn->close();

echo json_encode($response);
?>
