<?php

if (empty($_POST["fname"])) {
    die("Full Name is required");
}
if (empty($_POST["phonenumber"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$conn = require __DIR__ . "/connection.php";

// Get form inputs
$fullname = $_POST['fname'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$password = $password_hash;

$conn = new mysqli($database_host,  $database_user, $database_password, $database_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO lawyer (fullname, email, phonenumber, hash_password)
VALUES ('$fullname','$phonenumber', '$email',  '$password')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
