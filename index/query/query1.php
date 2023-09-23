<table border="1">
    <thead>
        <tr>
            <th>name</th>
            <th>author</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $authorArr = explode(";", $_POST["authors"]);
            $authorsStr = "'" . implode("', '", $authorArr) . "'";
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT name, author ".
            "FROM books ".
            "WHERE author IN (".$authorsStr.") ".
            "ORDER BY author DESC, name ASC;";
            $result = $dbcon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['author']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>