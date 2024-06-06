<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'lib';
      
    $conn = new mysqli($host, $user, $password, $database);
      
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE usermgmt2 SET name='$name', birthdate='$birthdate', email='$email', password='$password' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    header("Location: ../adset.php"); // Redirect back to the edit users page
    exit();
} else {
    echo "Invalid request";
    exit();
}
?>
