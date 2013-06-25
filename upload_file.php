<?php
        echo $_POST['filename'] . " " . $_POST['type'] ." " . $_POST['user'];
        echo "<form action='upload_file_true.php' method='post' enctype='multipart/form-data' >";
        echo "<input type='file' name='file'/> ";
echo "<input type='hidden' name='filename' value='" . $_POST['filename'] . "' />";
echo "<input type='hidden' name='type' value='" . $_POST['type'] . "' />";
echo "<input type='hidden' name='user' value='" . $_POST['user'] . "' />";
        echo "<br />";
        echo "<input type='submit' name='submit' value='Submit' />";
        echo "</form>";
?>