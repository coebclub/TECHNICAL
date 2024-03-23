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
    // Handle login form submission
    $login_register = $_POST['login_register'];
    $login_password = $_POST['login_password'];

    // SQL injection prevention: use prepared statements
    $stmt = $conn->prepare("SELECT * FROM users WHERE regd = ? AND password = ?");
    $stmt->bind_param('ss', $login_register, $login_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, redirect to welcome page
        header("Location: welcome.php");
        exit;
    } else {
        // User not found, redirect back to login page with error message
        header("Location: login_signup.php?login_error=1");
        exit;
    }
}
?>
