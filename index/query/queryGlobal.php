<h1>#1</h1>
<p>Список книг заданных авторов, упорядоченный по убыванию по авторам или по возрастанию по названиям</p>
<p>Значения вводить через символ ';'</p>
<form action="query1.php" method="post">
    <input type="text" name="authors">
    <button>Run</button>
</form>

<h2>#2</h2>
<p>Список клиентов, фамилии которых заканчиваются на «ов»</p>
<table border="1">
    <thead>
        <tr>
            <th>surname</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT surname ".
            "FROM clients ".
            "WHERE surname LIKE '%ов';";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['surname']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<h2>#3</h2>
<p>Список кодов книг, которые выдавались (без повторов)</p>
<table border="1">
    <thead>
        <tr>
            <th>book_id</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT DISTINCT book_id ".
            "FROM issuanceOfBooks;";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['book_id']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<h2>#4</h2>
<p>Список клиентов, которым выдавались книги с указанием количества выдач</p>
<table border="1">
    <thead>
        <tr>
            <th>client_id</th>
            <th>total_issues</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT client_id, COUNT(*) as total_issues ".
            "FROM issuanceOfBooks ".
            "GROUP BY client_id;";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['client_id']."</td>";
                echo "<td>".$row['total_issues']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<h2>#5</h2>
<p>Список книг, которые не выдавались</p>
<table border="1">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT id, name ".
            "FROM books ".
            "WHERE id NOT IN (SELECT DISTINCT book_id FROM issuanceOfBooks);";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<h2>#6</h2>
<p>Список клиентов, бравших книги более 5 раз</p>
<table border="1">
    <thead>
        <tr>
            <th>client_id</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT client_id ".
            "FROM issuanceOfBooks ".
            "GROUP BY client_id ".
            "HAVING COUNT(*) > 5;";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['client_id']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<h2>#7</h2>
<p>Список клиентов с полем, содержащим количество выдач книг данному клиенту</p>
<table border="1">
    <thead>
        <tr>
            <th>id</th>
            <th>surname</th>
            <th>number_of_issues</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT c.id, c.surname, IFNULL(COUNT(i.id), 0) as number_of_issues ".
            "FROM clients c ".
            "INNER JOIN issuanceOfBooks i ON c.id = i.client_id ".
            "GROUP BY c.id;";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['surname']."</td>";
                echo "<td>".$row['number_of_issues']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<h2>#8</h2>
<p>Список книг с указанием, сколько раз она выдавалась и среднего срока выдачи</p>
<table border="1">
    <thead>
        <tr>
            <th>book_id</th>
            <th>number_of_issues</th>
            <th>average_duration</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT book_id, COUNT(*) as number_of_issues, AVG(DATEDIFF(endDate, startDate)) as average_duration ".
            "FROM issuanceOfBooks ".
            "GROUP BY book_id;";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['book_id']."</td>";
                echo "<td>".$row['number_of_issues']."</td>";
                echo "<td>".$row['average_duration']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<h2>#9</h2>
<p>Список клиентов, бравших одну и ту же книгу более 1 раза. В списке отобразить  -название книги и сколько раз она бралась</p>
<table border="1">
    <thead>
        <tr>
            <th>book_name</th>
            <th>count_issued</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT b.name as book_name, COUNT(*) as count_issued ".
            "FROM issuanceOfBooks i ".
            "INNER JOIN books b ON i.book_id = b.id ".
            "GROUP BY client_id, book_id ".
            "HAVING count_issued > 1;";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['book_name']."</td>";
                echo "<td>".$row['count_issued']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<h2>#10</h2>
<p>Список книг, которые брались более 10 раз на срок не менее 30 дней</p>
<table border="1">
    <thead>
        <tr>
            <th>book_id</th>
            <th>count_issued</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT book_id, COUNT(*) as count_issued ".
            "FROM issuanceOfBooks ".
            "WHERE DATEDIFF(endDate, startDate) >= 30 ".
            "GROUP BY book_id ".
            "HAVING count_issued > 10;";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['book_id']."</td>";
                echo "<td>".$row['count_issued']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>