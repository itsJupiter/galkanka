<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
    require_once 'head.php';
$user=$_SESSION['user'];
$type=$_POST['type'];
$_SESSION['type']=$type;
$filename=$_POST['filename'];
$_SESSION['filename']=$filename;
echo $type." ".$user."你要重新下载".$filename."<br/>";
if($type=='proofread')
    {
       if(getdata('proofread',$filename,'proofreader')==$user)
           echo "点击<a href='downtext.php'>下载翻译后文件</a>";
       else
           echo "你不拥有此任务！";
    }
elseif($type=='polish')
    if(getdata('polish',$filename,'polisher')==$user)
        echo "点击<a href='downtext.php'>下载翻译后文件</a>";
    else
        echo "你不拥有此任务！";
?>
