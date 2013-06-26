<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <title>现妹汉化组在线领取系统v0.001</title>
</head>
<h1>现妹汉化组在线领取系统</h1>
<?php
include 'HttpClient.class.php';
if($_POST)
    {
        $user=$_POST["user"];
        $pwd=$_POST["password"];
        $sql = mysql_connect("localhost","root","chinaman");

                if (!$sql)
                    {
                        die('Could not connect: ' . mysql_error());
                    }//如果连接失败则报错
                mysql_select_db("galkanka", $sql);//选择数据库，这里是galkanka
                $temp=mysql_query("SELECT * FROM usercheck");
                $success=0;
                while($row=mysql_fetch_array($temp))
                    {
                        if($row['username']==$user && $row['userpwd']==$pwd)
                            {
                                $success=1;
                                $pms=$row['userpms'];
                                break;
                            }
                    }
                if($success!=1)
                    {
                        echo "Login failed!";
                    }
                else
                    {
                        switch($_POST['radio'])
                            {
                            case "translate":
                                if($pms==1||$pms==0){
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/translate.php";
                                $params=array('user'=>$row['username']);
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                                }
                                else
                                    echo "你不能登入翻译系统！";
                                break;
                            case "proofread":
                                if($pms==1||$pms==0){
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/proofread.php";
                                $params=array('user'=>$row['username']);
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                                }
                                else
                                    echo "你不能登入校对系统！";
                                break;
                            case "polish":
                                if($pms==3||$pms==0){
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/polish.php";
                                $params=array('user'=>$row['username']);
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                                }
                                else
                                    echo "你不能登入润色系统！";
                                break;
                            }
                    }
    }
else
    {
        echo "<form action='login.php' method='post'>";
        echo "用户名:";
        echo "<input type='text' name='user' />";
        echo "<br />";
        echo "密码:";
        echo "<input type='password' name='password' />";
        echo "<br />";
        echo "<input type='radio' name='radio' value='translate' />翻译";
        echo "<br />";
        echo "<input type='radio' name='radio' value='proofread' />校对";
        echo "<br />";
        echo "<input type='radio' name='radio' value='polish' />润色";
        echo "<br />";
        echo "<input type='submit' value='登录' />";
        echo "</form>";
 }
?>
<br/>
<br/>
<br/>
可以在<br/>
http://219.218.109.221/galkanka/original/ <br/>
http://219.218.109.221/galkanka/translated/ <br/>
http://219.218.109.221/galkanka/proofreaded/ <br/>
直接下载文本，用于对照前后文。
<br/>
<br/>
<p>ChangeLog:</p>
<p>v0.006 用户验证由php代码转移至数据库。</p>
<p>v0.005 翻译部分的上传功能完工。翻译们现在可以提交完成的文本，校对也可以登录领取文本来校对了！ (不过要先让我帮你注册)<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下一版将把用户验证迁移到数据库以便增加新人</p>
<p>v0.001 虽还未完工上传部分但因需要先投入使用</p>
<br/>
<p>TODO list:</p>
                                                                                                                       <del>用户验证由php代码转移至数据库</del>&nbsp;完成于v0.006 2013-06-27<br/>
用户验证由简单post转移到cookie+session<br/>
上传功能(于v0.005部分完成)<br/>
显示自己所领取的任务<br/>
只显示未领取<br/>
批量领取<br/>
批量上传<br/>
界面美化<br/>
<html>