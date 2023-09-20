<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET["id"];
        $book_id = $_POST['book_id'];
        $client_id = $_POST['client_id'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        
        $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");

        if ($dbcon->connect_error) {
            die("Connection failed: " . $dbcon->connect_error);
        }

        $sql = "UPDATE issuanceofbooks
                SET book_id = $book_id, client_id = $client_id, startDate = '$startDate', endDate = '$endDate'
                WHERE id = $id";
                
        if ($dbcon->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $dbcon->error;
        }

        $dbcon->close();
    }
    header("Location: ../index.php");
    exit;
?>