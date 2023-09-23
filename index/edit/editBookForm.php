<?php
    $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
    $id = $_GET['id'];

    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $dbcon->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $author = $row['author'];
    } else {
        echo "No book found";
        exit();
    }

    echo '<h2>Input new value</h2>'.
        '<form action="editBook.php?id='.$_GET["id"].'" method="post">'.
        '    <input type="text" name="name" placeholder="Book Name" value="'.$name.'">'.
        '    <input type="text" name="author" placeholder="Author" value="'.$author.'">'.
        '    <input type="submit" value="Edit Book">'.
        '</form>';
?>