<?php
    $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM issuanceofbooks WHERE id = $id";
        if ($dbcon->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $dbcon->error;
        }
    } else {
        echo "Invalid ID or ID not set";
    }

    $dbcon->close();

    header("Location: ../index.php");
    exit;
?>
