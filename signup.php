<?php
// start session
session_start();

// check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get name, email, and password from form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // hash and salt password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // connect to database
  $db = new mysqli('localhost', 'username', 'password', 'dbname');
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // prepare and execute query to insert new user
  $stmt = $db->
