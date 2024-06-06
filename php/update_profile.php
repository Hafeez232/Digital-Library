<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lib';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE usermgmt2 SET name=?, birthdate=?, email=?, password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    // Treat all parameters as strings
    $stmt->bind_param("ssssi", $name, $birthdate, $email, $password, $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully.";
    } else {
        $_SESSION['error'] = "Error updating profile: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../profile.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>
