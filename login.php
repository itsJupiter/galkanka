<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <title>My萌汉化组在线领取系统v0.01</title>
</head>
<h1>My萌汉化组在线领取系统</h1>
 <p>请先阅读<a href="../index.html">工作说明v1</a>更新于2013-7-12</p>
 <p>请再阅读<a href="../bbs/forum.php?mod=viewthread&tid=6&extra=page%3D1">翻译心得</a>更新于2013-7-17</p>
 <p><a href="../bbs/">工作用论坛</a>已经开启，请翻译讨论等在论坛进行</p>
<p>v0.01对代码进行了较大变动，如发现bug请尽快通知j3</p>
<?php
require_once 'HttpClient.class.php';
require_once 'head.php';
if($_POST)
    {
        $_SESSION['user']=$_POST["user"];
        $pwd=$_POST["password"];
        $usercheck=mysql_query("SELECT * FROM usercheck");
        $success=0;
        while($row=mysql_fetch_array($usercheck))
            {
                if($row['username']==$_SESSION['user'] && $row['userpwd']==$pwd)
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
                        if($pms==1||$pms==7||$pms==3||$pms==5){
                            $goto="translate.php";
                            header("location:$goto");
                            exit();
                        }
                        else
                            echo "你不能登入翻译系统！";
                        break;
                    case "proofread":
                        if($pms==2||$pms==7||$pms==3||$pms==6){
                          $goto="proofread.php";
                          header("location:$goto");
                          exit();
                        }
                        else
                            echo "你不能登入校对系统！";
                        break;
                    case "polish":
                        if($pms==4||$pms==7||$pms==5||$pms==6){
                            $goto="polish.php";
                            header("location:$goto");
                            exit();
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
<p>v0.025 修复潜在bug--同时打开领取网页导致的可能重复领取同一文本（后者覆盖前者)</p>
<p>v0.02 添加重新提交功能。翻译在校对没有领走任务之前可以重新提交翻译文本，校对也可以在润色领走任务前重新提交校对文本。<br/>可以无限次重新提交，但仅保留前一次的文本备份。
<p>v0.01 完成所有上传功能，用户验证迁移到session</p>
<p>v0.007-1 对完成情况区分颜色直观</p>
<p>v0.007 添加了填写大致内容功能</p>
<p>v0.006 用户验证由php代码转移至数据库。</p>
<p>v0.005 翻译部分的上传功能完工。翻译们现在可以提交完成的文本，校对也可以登录领取文本来校对了！ (不过要先让我帮你注册)<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下一版将把用户验证迁移到数据库以便增加新人</p>
<p>v0.001 虽还未完工上传部分但因需要先投入使用</p>
<br/>
<p>TODO list:</p>
<del>用户验证由php代码转移至数据库</del>&nbsp;完成于v0.006 2013-06-27<br/>
<del>用户验证由简单post转移到cookie+session</del>&nbsp;已转换为session，放弃加入cookie<br/>
<del>上传功能</del>&nbsp; 完成于v0.01<br/>
显示自己所领取的任务<br/>
只显示未领取<br/>
批量领取<br/>
批量上传<br/>
界面美化<br/>
<html>