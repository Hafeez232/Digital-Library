<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lib';

$con = mysqli_connect($host, $user, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    
    $selectQuery = "SELECT * FROM pdf_data WHERE id = $book_id";
    $squery = mysqli_query($con, $selectQuery);
    
    if(mysqli_num_rows($squery) > 0) {
        $result = mysqli_fetch_assoc($squery);
        $pdf_file = "../pdf/" . $result['filename'];
        
        if(file_exists($pdf_file)) {
            header("Content-type: application/pdf");
            readfile($pdf_file);
        } else {
            echo "PDF file not found!";
        }
    } else {
        echo "PDF record not found!";
    }
} else {
    echo "Invalid book ID!";
}

mysqli_close($con);
?>
