<?php

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
    echo "";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Close connection to create a new connection to the created database
$conn->close();

// Connect to the newly created database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql_create_table = "CREATE TABLE IF NOT EXISTS usermgmt2 (
    id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
    
)";

// Execute SQL to create table
if ($conn->query($sql_create_table) === TRUE) {
    echo "";
} else {
    echo "Error creating table : " . $conn->error;
}

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//process form data 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $birthdate = $_POST["birthdate"];
    $email = $_POST["email"];
    $password = $_POST["password"];

//insert data into databased    
$sql = "INSERT INTO usermgmt2 (name, birthdate, email, password) VALUES ('$name', '$birthdate', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../index.php?signupSuccess=true");
    } else {
        echo "Error creating record" .$conn->error;
    }
}

$conn->close();
?>