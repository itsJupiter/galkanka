<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
require_once 'head.php';
$filename = $_POST['filename'];
$user = $_SESSION['user'];
if(getdata('polish',$filename,'state')==0)
    {
echo "已经成功领取，";
echo "<a href='./proofreaded/" . $filename . ".txt'>请右击另存为</a>";
$date=date("Y-m-d");
updata('polish',$filename,'state','1');
updata('polish',$filename,'polisher',$user);
updata('polish',$filename,'polishdate',$date);
mysql_close($con);
    }
else
    echo "该文件已被他人领取！";
?>