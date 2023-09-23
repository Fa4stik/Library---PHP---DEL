<?php
    $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");

    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }

    $book_id = $_POST['book_id'];
    $client_id = $_POST['client_id'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $sql = "INSERT INTO issuanceofbooks(book_id, client_id, startDate, endDate) VALUES ($book_id, $client_id, '$startDate', '$endDate')";

    if ($dbcon->query($sql) === TRUE) {
        echo "New book added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $dbcon->error;
    }

    $dbcon->close();

    header("Location: ../index.php");
    exit;
?>