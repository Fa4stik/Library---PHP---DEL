<?php
    $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
    $id = $_GET['id'];

    $sql = "SELECT * FROM clients WHERE id = $id";
    $result = $dbcon->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $surname = $row['surname'];
    } else {
        echo "No book found";
        exit();
    }
    echo '<h2>Input new value</h2>'.
        '<form action="editClient.php?id='.$_GET["id"].'" method="post">'.
        '    <input type="text" name="surname" placeholder="Surname" value="'.$surname.'">'.
        '    <input type="submit" value="Edit Client">'.
        '</form>';
?>