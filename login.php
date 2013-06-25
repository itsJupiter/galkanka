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
        switch($_POST['radio'])
            {
            case translate:
                switch($_POST['user'])
                    {
                    case itsjupiter:
                        if($_POST['password']=='chinaman')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/translate.php";
                                $params=array('user'=>'itsjupiter');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                        else
                            echo "Login failed.";
                        break;
                    case wuyan:
                        if($_POST['password']=='moenyaa')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/translate.php";
                                $params=array('user'=>'wuyan');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                            else
                                echo "Login failed.";
                        break;
                    case zhilianwan:
                        if($_POST['password']=='000000')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/translate.php";
                                $params=array('user'=>'zhilianwan');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                        else
                            echo "Login failed.";
                        break;
                    case sheduowan:
                        if($_POST['password']=='123456')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/translate.php";
                                $params=array('user'=>'sheduowan');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                        else
                            echo "Login failed.";
                        break;
                    }
                break;
            case proofread:
                switch($_POST['user'])
                    {
                    case itsjupiter:
                        if($_POST['password']=='chinaman')
                            {
                               $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/proofread.php";
                                $params=array('user'=>'itsjupiter');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                            else
                                echo "Login failed.";
                        break;
                    case wuyan:
                        if($_POST['password']=='moenyaa')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/proofread.php";
                                $params=array('user'=>'wuyan');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                            else
                                echo "Login failed.";
                        break;
                    case zhilianwan:
                        if($_POST['password']=='000000')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/proofread.php";
                                $params=array('user'=>'zhilianwan');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                        else
                            echo "Login failed.";
                        break;
                    case sheduowan:
                        if($_POST['password']=='123456')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/proofread.php";
                                $params=array('user'=>'sheduowan');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                        else
                            echo "Login failed.";
                        break;
                    }
                break;

            case polish:
                switch($_POST['user'])
                    {
                    case itsjupiter:
                        if($_POST['password']=='chinaman')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/polish.php";
                                $params=array('user'=>'itsjupiter');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                        else
                            echo "Login failed.";
                        break;
                    case wuyan:
                        if($_POST['password']=='moenyaa')
                            {
                                $Client=new HttpClient("127.0.0.1");
                                $url = "http://localhost/galkanka/polish.php";
                                $params=array('user'=>'wuyan');
                                $pageContents = HttpClient::quickPost($url,$params);
                                echo $pageContents;
                            }
                        else
                            echo "Login failed.";
                        break;
                    default:
                        echo "Login failed.";
                        break;
                    }
                break;
            default:
                echo "Please choose someone";
                break;
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
<p>v0.005 翻译部分的上传功能完工。翻译们现在可以提交完成的文本，校对也可以登录领取文本来校对了！ (不过要先让我帮你注册)<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下一版将把用户验证迁移到数据库以便增加新人</p>
<p>v0.001 虽还未完工上传部分但因需要先投入使用</p>
<br/>
<p>TODO list:</p>
用户验证由php代码转移至数据库<br/>
用户验证由简单post转移到cookie+session<br/>
上传功能(于v0.005部分完成)<br/>
显示自己所领取的任务<br/>
只显示未领取<br/>
批量领取<br/>
批量上传<br/>
界面美化<br/>
<html>