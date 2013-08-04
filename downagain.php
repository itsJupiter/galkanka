<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
    require_once 'head.php';
$user=$_SESSION['user'];
$type=$_POST['type'];
$filename=$_POST['filename'];
echo $type." ".$user."你要重新下载".$filename."<br/>";
if($type=='proofread')
    {
        if(getdata('proofread',$filename,'proofreader')==$user)
            downtext("proofread",$filename);
    }
elseif($type=='polish')
    if(getdata('polish',$filename,'polisher')==$user)
        downtext("polish",$filename);
?>
