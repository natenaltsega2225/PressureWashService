<?php
// start session
session_start();

// check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get email and password from form
  $email = $_POST['email'];
  $password = $_POST['password'];

  // connect to database
  $db = new mysqli('localhost', 'username', 'password', 'dbname');
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // prepare and execute query to get user with matching email
  $stmt = $db->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($id, $name, $email, $hashed_password);
  $stmt->fetch();
  $stmt->close();

  // check if password is correct
  if (password_verify($password, $hashed_password)) {
    // authentication successful, store user data in session
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    // redirect to dashboard or home page
    header("Location: dashboard.php");
    exit();
  } else {
    // authentication failed, display error message
    $error_msg = "Invalid email or password.";
  }

  $db->close();
}
?>
