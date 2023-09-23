<?php
    echo '<h2>Input new value</h2>'.
        '<form action="editClient.php?id='.$_GET["id"].'" method="post">'.
        '    <input type="text" name="surname" placeholder="Surname">'.
        '    <input type="submit" value="Edit Client">'.
        '</form>';
?>