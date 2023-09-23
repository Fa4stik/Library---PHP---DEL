<?php
    $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
    $id = $_GET['id'];

    $sql = "SELECT b.name, c.surname, i.startDate, i.endDate
    FROM issuanceofbooks i
    LEFT JOIN books b on b.id = i.book_id
    LEFT JOIN clients c on c.id = i.client_id
    WHERE i.id = $id";
    $result = $dbcon->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $surname = $row['surname'];
        $startDate = $row['startDate'];
        $endDate = $row['endDate'];
    } else {
        echo "No book found";
        exit();
    }

    echo '<h2>Input new value</h2>'.
        '<form action="editIssuance.php?id='.$_GET["id"].'" method="post">'.
        '    <input type="text" name="book_id" placeholder="Book id" value="'.$name.'">'.
        '    <input type="text" name="client_id" placeholder="Client id" value="'.$surname.'">'.
        '    <input type="date" name="startDate" placeholder="Start date" value="'.$startDate.'">'.
        '    <input type="date" name="endDate" placeholder="End date" value="'.$endDate.'">'.
        '    <input type="submit" value="Edit Issuance">'.
        '</form>';
?>