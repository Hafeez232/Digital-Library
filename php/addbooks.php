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
$sql_create_table = "CREATE TABLE IF NOT EXISTS addbooks (
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    published_date DATE NOT NULL
)";

// Execute SQL to create table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'books' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//process form data 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST["title"];
    $author = $_POST["author"];
    $price = $_POST["price"];
    $published_date = $_POST["published_date"];


//insert data into databased    
$sql = "INSERT INTO addbooks (title, author, price, published_date) VALUES ('$title','$author', '$price', '$published_date')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../addbooks.html");
    } else {
    echo "Error creating record: " . $conn->error;
}
}
// Close connection
$conn->close();
?>
