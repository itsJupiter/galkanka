<?php

        echo $_POST['filename'] . " " . $_POST['type'] ." " . $_POST['user'];
        echo "<form action='upload_file_true.php' method='post'>";
        echo "<input type='file' name='file' id='file' /> ";
        echo "<br />";
        echo "<input type='submit' name='submit' value='Submit' />";
        echo "</form>";
?>