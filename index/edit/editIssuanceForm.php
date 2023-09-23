<?php
    echo '<h2>Input new value</h2>'.
        '<form action="editIssuance.php?id='.$_GET["id"].'" method="post">'.
        '    <input type="text" name="book_id" placeholder="Book id">'.
        '    <input type="text" name="client_id" placeholder="Client id">'.
        '    <input type="date" name="startDate" placeholder="Start date">'.
        '    <input type="date" name="endDate" placeholder="End date">'.
        '    <input type="submit" value="Edit Issuance">'.
        '</form>';
?>