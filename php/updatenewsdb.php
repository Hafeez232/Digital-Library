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
$sql_create_table = "CREATE TABLE IF NOT EXISTS news (
    title VARCHAR(255) NOT NULL,
    news_date VARCHAR(50) NOT NULL,
    content VARCHAR(255) NOT NULL
    )";

// Execute SQL to create table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'news' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//process form data 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST["title"];
    $news_date = $_POST["news_date"];
    $content = $_POST["content"];


//insert data into databased    
$sql = "INSERT INTO news (title, news_date, content) VALUES ('$title','$news_date', '$content')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../updatenews.html");
    } else {
    echo "Error creating record: " . $conn->error;
}
}
// Close connection
$conn->close();
?>
