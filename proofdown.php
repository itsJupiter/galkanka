<?php session_start();?>
<?php
 require_once 'head.php';
$filename = $_POST['filename'];
$user = $_SESSION['user'];
$_SESSION['filename']=$filename;
$_SESSION['type']='proofread';
if(getdata('proofread',$filename,'state')==0)
{
echo "已经成功领取，";
echo "日文原文件：<a href='./original/" . $filename . ".txt'>请右击另存为</a><br/>";
Echo "翻译后文件：请<a href='downtext.php'>点击下载</a>";
$date=date("Y-m-d");
updata('proofread',$filename,'state','1');
updata('proofread',$filename,'proofreader',$user);
updata('proofread',$filename,'proofdate',$date);
mysql_close($con);
}
else
    echo "该文件已被他人领取！";
?>
