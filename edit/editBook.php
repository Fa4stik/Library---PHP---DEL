<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET["id"];
        $name = $_POST["name"];
        $author = $_POST["author"];
        
        $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");

        if ($dbcon->connect_error) {
            die("Connection failed: " . $dbcon->connect_error);
        }

        $sql = "UPDATE books
                SET name = '$name', author = '$author'
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