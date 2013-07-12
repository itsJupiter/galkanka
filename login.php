<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <title>My萌汉化组在线领取系统v0.007-1</title>
</head>
<h1>My萌汉化组在线领取系统</h1>
 <p>请先阅读<a href="./readme.txt">工作说明v1</a>更新于2013-7-9</p>
<?php
require_once 'HttpClient.class.php';
require_once 'head.php';
if($_POST)
    {
        $user=$_POST["user"];
        $pwd=$_POST["password"];
        $usercheck=mysql_query("SELECT * FROM usercheck");
        $success=0;
        while($row=mysql_fetch_array($usercheck))
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
<br/>
<br/>
<p>ChangeLog:</p>
<p>v0.007-1 对完成情况区分颜色直观</p>
<p>v0.007 添加了填写大致内容功能</p>
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