<?php
    $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
    $id = $_GET['id'];

    $sql = "SELECT i.book_id, i.client_id, b.name, c.surname, i.startDate, i.endDate
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
        $client_id = $row['client_id'];
        $book_id = $row['book_id'];
    } else {
        echo "No book found";
        exit();
    }

    $books_result = $dbcon->query("SELECT id, name FROM books");
    $books_options = '';
    while ($book = $books_result->fetch_assoc()) {
        $selected = $book['id'] == $book_id ? 'selected' : '';
        $books_options .= "<option value='{$book['id']}' $selected>{$book['name']}</option>";
    }

    $clients_result = $dbcon->query("SELECT id, surname FROM clients");
    $clients_options = '';
    while ($client = $clients_result->fetch_assoc()) {
        $selected = $client['id'] == $client_id ? 'selected' : '';
        $clients_options .= "<option value='{$client['id']}' $selected>{$client['surname']}</option>";
    }

    echo '<h2>Input new value</h2>'.
        '<form action="editIssuance.php?id='.$_GET["id"].'" method="post">'.
        '    <select name="book_id">' . $books_options . '</select>'.
        '    <select name="client_id">' . $clients_options . '</select>'.
        '    <input type="date" name="startDate" placeholder="Start date" value="'.$startDate.'">'.
        '    <input type="date" name="endDate" placeholder="End date" value="'.$endDate.'">'.
        '    <input type="submit" value="Edit Issuance">'.
        '</form>';
?>