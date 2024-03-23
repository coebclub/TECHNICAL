<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "COEB_CLUB";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle signup form submission
    $signup_name = $_POST['signup_name'];
    $signup_email = $_POST['signup_email'];
    $signup_password = $_POST['signup_password'];
    $signup_register = $_POST['signup_register'];

    // SQL injection prevention: use prepared statements
    $stmt = $conn->prepare("INSERT INTO users (Regd, Name, Email, Password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $signup_register, $signup_name, $signup_email, $signup_password);

    if ($stmt->execute() === TRUE) {
        // User inserted successfully, redirect to welcome page
        header("Location: welcome.php");
        exit;
    } else {
        // Error occurred while inserting user, redirect back to signup page with error message
        header("Location: login_signup.php?signup_error=1");
        exit;
    }
}
?>
