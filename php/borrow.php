<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Result</title>
    <style>
        * {
          box-sizing: border-box;
          font-family: Arial, Helvetica, sans-serif;
        }
        
        body {
          margin: 0;
          font-family: Arial, Helvetica, sans-serif;
        }
        
        /* Header */
        .header {
          overflow: hidden;
          background-color: #3899e8;
        }
        
        .header h2 {
          color: #f2f2f2;
          text-align: center;
          padding: 14px 0;
          margin: 0;
        }
        
        /* Content */
        .content {
          background-color: #ddd;
          padding: 10px;
          text-align: center;
          margin-top: 20px;
        }
        
        /* Button */
        .button-container {
          text-align: center;
          margin-top: 20px;
        }
        
        .button-container button {
          padding: 10px 20px;
          background-color: #4CAF50;
          border: none;
          color: white;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin-right: 10px;
          cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Borrowing Successful!</h2>
    </div>
    <?php
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "addbooks";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST['username'];
        $bookTitle = $_POST['bookTitle'];
        $borrow_date = $_POST['borrow_date'];
        $return_date = $_POST['return_date'];

        // SQL to insert data into the borrowing table
        $sql = "INSERT INTO borrowing (username, bookTitle, borrow_date, return_date) VALUES ('$username', '$bookTitle', '$borrow_date', '$return_date')";

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {
            echo "<div class='content'>";
            echo "<p><strong>Result</strong></p>";
            echo "<p>User ID: " . htmlspecialchars($username) . "</p>";
            echo "<p>Book Title: " . htmlspecialchars($bookTitle) . "</p>";
            echo "<p>Borrowing Date: " . htmlspecialchars($borrow_date) . "</p>";
            echo "<p>Return Date: " . htmlspecialchars($return_date) . "</p>";
            echo "</div>";
            echo "<div class='button-container'>";
            echo "<a href='form.html'><button>Back</button></a>";
            echo "<a href='lib.html'><button>My Library</button></a>";
            echo "</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // If form not submitted, display an error message
        echo "<div class='content'>";
        echo "<p>Error: Form not submitted</p>";
        echo "<p>Please go back and submit the form.</p>";
        echo "</div>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
