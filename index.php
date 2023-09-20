<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- BOOK -->
    <h2>Books</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
                $result = $dbcon->query("SELECT * FROM books");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['author']."</td>";
                    echo "<td><a href='edit/editBookForm.php?id=".$row['id']."'>Edit</a> | <a href='delete/deleteBook.php?id=".$row['id']."'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <form action="add/addBook.php" method="post">
        <input type="text" name="name" placeholder="Book Name">
        <input type="text" name="author" placeholder="Author">
        <input type="submit" value="Add Book">
    </form>

    <!-- Clients -->
    <h2>Clients</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Surname</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $result = $dbcon->query("SELECT * FROM clients");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['surname']."</td>";
                    echo "<td><a href='edit/editClientForm.php?id=".$row['id']."'>Edit</a> | <a href='delete/deleteClient.php?id=".$row['id']."'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <form action="add/addClient.php" method="post">
        <input type="text" name="surname" placeholder="Surname">
        <input type="submit" value="Add Client">
    </form>

    <!-- Issuance -->
    <h2>Issuance of books</h2>
    <table border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>book_id</th>
                <th>client_id</th>
                <th>startDate</th>
                <th>endDate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $result = $dbcon->query("SELECT * FROM issuanceofbooks");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['book_id']."</td>";
                    echo "<td>".$row['client_id']."</td>";
                    echo "<td>".$row['startDate']."</td>";
                    echo "<td>".$row['endDate']."</td>";
                    echo "<td><a href='edit/editIssuanceForm.php?id=".$row['id']."'>Edit</a> | <a href='delete/deleteIssuance.php?id=".$row['id']."'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <form action="add/addIssuance.php" method="post">
        <input type="text" name="book_id" placeholder="Book id">
        <input type="text" name="client_id" placeholder="Client id">
        <input type="date" name="startDate" placeholder="Start date">
        <input type="date" name="endDate" placeholder="End date">
        <input type="submit" value="Add Issuance">
    </form>
</body>
</html>
<!-- browser-sync start --proxy="localhost:3000" --files="*.php" -->
<!-- $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306"); -->