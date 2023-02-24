<?php
// Retrieve data from the book.html form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];

// Connect to the MySQL database
$host = 'localhost';
$username = 'username';
$password = 'password';
$dbname = 'database_name';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Insert the appointment data into the appointments table
$sql = "INSERT INTO appointments (name, email, phone, date, time)
VALUES ('$name', '$email', '$phone', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
  echo "Appointment booked successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
