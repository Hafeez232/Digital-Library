<?php
$searchQuery = $_GET['q'];
$conn = new mysqli("localhost", "root", "", "lib");

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$sql = "SELECT id, name, birthdate, email, password FROM usermgmt2 WHERE name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = 1;
    echo "<ul style='background-color: white;'>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>$counter. Name: {$row['name']}, Birth-Date: {$row['birthdate']}, Email: {$row['email']}</li>";
        $counter++;
    }
    echo "</ul>";
} else {
    echo "<p>No users found.</p>";
}

$conn->close();
?>