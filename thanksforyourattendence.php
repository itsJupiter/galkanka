<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<body>
<?php
require_once('head.php');
$user=$_SESSION['user'];
echo "感谢您曾经的付出，" . $user . "！如果您有意重新加入汉化组，请加群158755524";

?>


