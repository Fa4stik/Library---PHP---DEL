<?php 
    $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");

    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }

    $bookName = $_POST['name'];
    $author = $_POST['author'];

    $sql = "INSERT INTO books (name, author) VALUES ('$bookName', '$author')";

    if ($dbcon->query($sql) === TRUE) {
        echo "New book added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $dbcon->error;
    }

    $dbcon->close();

    header("Location: ../index.php");
    exit;
?>