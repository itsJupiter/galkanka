<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
 require_once 'head.php';
$filename = $_POST['filename'];
$user = $_SESSION['user'];
echo "已经成功领取，";
echo "<a href='./original/" . $filename . ".txt'>请右击另存为</a>";
$date=date("Y-m-d");
updata('translate',$filename,'state','1');
updata('translate',$filename,'translator',$user);
updata('translate',$filename,'translate',$date);
mysql_close($con);
?>