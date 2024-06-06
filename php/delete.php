<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lib';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare a delete statement
    $sql = "DELETE FROM usermgmt2 WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $id);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Close statement
            $stmt->close();
            
            // Close connection
            $conn->close();
            
            // Redirect back to adset.php
            header("Location: ../adset.php");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

// Close connection
$conn->close();
?>
