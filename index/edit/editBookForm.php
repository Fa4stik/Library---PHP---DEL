<?php
    echo '<h2>Input new value</h2>'.
        '<form action="editBook.php?id='.$_GET["id"].'" method="post">'.
        '    <input type="text" name="name" placeholder="Book Name">'.
        '    <input type="text" name="author" placeholder="Author">'.
        '    <input type="submit" value="Edit Book">'.
        '</form>';
?>