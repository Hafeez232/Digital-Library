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

// Create connection
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql_create_db = "CREATE DATABASE IF NOT EXISTS lib";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Close connection to create a new connection to the created database
$conn->close();

// Connect to the newly created database
$database = "lib";
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql_create_table = "CREATE TABLE IF NOT EXISTS borrow (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    bookname VARCHAR(50) NOT NULL,
    borrowingdate DATE NOT NULL,
    returndate DATE NOT NULL
)";

// Execute SQL to create table
if ($conn->query($sql_create_table) !== TRUE) {
    echo "Table 'news' created successfully";
} else {
    echo "Error creating table" . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookname = $_POST['book-id'];
    $borrowingdate = $_POST['borrow-date'];
    $returndate = $_POST['return-date'];

    // Calculate remaining days
    $borrowing_date = new DateTime($borrowingdate);
    $return_date = new DateTime($returndate);
    $interval = $borrowing_date->diff($return_date);
    $remaining_days = $interval->days;

    // Get the user's name
    $sql_user = "SELECT name FROM usermgmt2 WHERE id = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("i", $_SESSION['user_id']);
    $stmt_user->execute();
    $stmt_user->bind_result($name);
    $stmt_user->fetch();
    $stmt_user->close();

    // Insert borrowing details into the borrow table
    $sql_insert = "INSERT INTO borrow (name, bookname, borrowingdate, returndate) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ssss", $name, $bookname, $borrowingdate, $returndate);

    if ($stmt_insert->execute()) {
        $_SESSION['borrow_details'] = [
            'name' => $name,
            'bookname' => $bookname,
            'borrowingdate' => $borrowingdate,
            'returndate' => $returndate,
            'remaining_days' => $remaining_days
        ];
        $_SESSION['borrow_success'] = "Book borrowed successfully.";
    } else {
        $_SESSION['borrow_error'] = "Error borrowing book: " . $conn->error;
    }

    $stmt_insert->close();
    $conn->close();

    header("Location: ../newform.php");
    exit();
}

$conn->close();
?>