<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lib';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, name, password FROM usermgmt2 WHERE name = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $stored_password);
        $stmt->fetch();

        // Verify the password
        if ($password === $stored_password) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            header("Location: ../home.html");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['error'] = "Invalid password.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        // Username not found
        $_SESSION['error'] = "No username found!";
        header("Location: ../index.php");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>
