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
            $id = $_POST['id'];
            $dbcon = new mysqli("127.0.0.1", "root", "1234", "Library", "3306");
            if ($dbcon->connect_error) {
                die("Connection failed: " . $dbcon->connect_error);
            }
            $sql = "SELECT c.id, c.surname, IFNULL(COUNT(i.id), 0) as number_of_issues ".
            "FROM clients c ".
            "INNER JOIN issuanceOfBooks i ON c.id = i.client_id ".
            "WHERE c.id = $id ".
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