<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
require_once 'head.php';
$info=$_POST['info'];
$filename=$_POST['filename'];
mysql_query("UPDATE translate SET info='$info' WHERE filename='$filename'");
echo "成功";
?>