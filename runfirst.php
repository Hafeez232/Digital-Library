<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lib';

// Create connection to MySQL
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully.<br>";
} else {
    die("Error creating database: " . $conn->error . "<br>");
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
$sql_create_table = "CREATE TABLE IF NOT EXISTS pdf_data (
    id INT PRIMARY KEY,
    bookname VARCHAR(255) NOT NULL,
    filename VARCHAR(255) NOT NULL
)";

// Execute SQL to create table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table created successfully.<br>";
} else {
    die("Error creating table: " . $conn->error . "<br>");
}

// SQL to insert data using INSERT IGNORE
$sql_insert_data = "INSERT IGNORE INTO pdf_data (id, bookname, filename) VALUES
    (1, 'Harry Potter And The Prisoner of Azkaban', 'HarryPotter.pdf'),
    (11, 'Psychology', 'Psychology.pdf'),
    (10, 'Anatomy', 'Anatomy.pdf'),
    (8, 'Napoleon', 'Napoleon.pdf'),
    (12, 'Philosophy', 'Philosophy.pdf')";

// Execute SQL to insert data
if ($conn->query($sql_insert_data) === TRUE) {
    header("Location: index.php");
} else {
    die("Error inserting data: " . $conn->error . "<br>");
}

// Close the connection
$conn->close();

?>
