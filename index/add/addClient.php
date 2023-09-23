<?php
    $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");

    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }

    $surname = $_POST['surname'];

    $sql = "INSERT INTO clients(surname) VALUES ('$surname')";

    if ($dbcon->query($sql) === TRUE) {
        echo "New book added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $dbcon->error;
    }

    $dbcon->close();

    header("Location: ../index.php");
    exit;
?>