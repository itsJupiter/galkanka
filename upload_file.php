<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
 echo "上传文件：".$_POST['filename'] . "上传目标： " . $_POST['type'] ." 当前用户： " . $_SESSION['user'];
echo "<form action='upload_file_true.php' method='post' enctype='multipart/form-data' >";
echo "<input type='file' name='file'/> ";
echo "<input type='hidden' name='filename' value='" . $_POST['filename'] . "' />";
echo "<input type='hidden' name='type' value='" . $_POST['type'] . "' />";
        echo "<br />";
        echo "<input type='submit' name='submit' value='Submit' />";
        echo "</form>";
?>