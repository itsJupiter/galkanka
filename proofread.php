<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<?php
require_once 'head.php';
if($_SESSION['user'])
    {
        $user=$_SESSION['user'];
        echo "<p>当前用户为" . $user . "</p>";
        echo "<h1>校对领取表</h1>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>文件名</th>";
        echo "<th>文件大小</th>";
        echo "<th>翻译者</th>";
        echo "<th>翻译时间</th>";
        echo "<th>当前状态</th>";
        echo "<th>校对者</th>";
        echo "<th>校对时间</th>";
        echo "<th>&nbsp;</th>";
        echo "</tr>";
//以上输出表头
        $proofread= mysql_query("SELECT * FROM proofread order by filename asc");//将proofread表按文件名排序传递给$proofread变量
        while($row = mysql_fetch_array($proofread))//mysql_fetch_array返回数据，每调用一次返回下一组数据。
            {
                echo "<tr>";
                echo "<td>" . $row['filename'] . "</td>";
                echo "<td>" . $row['filesize'] . "</td>";
                echo "<td>" . $row['translator'] . "</td>";
                echo "<td>" . $row['transdate'] . "</td>";
                switch($row['state'])
                    {
                    Case '0' : echo "<td>" . "<font color='red'>未领取</font>" . "</td>";break;
                    case '1': echo "<td>" . "<font color='blue'>正在进行</font>" . "</td>";break;
                    case '2' : echo "<td>" . "<font color='green'>已完成</font>" . "</td>";break;
                    }
                echo "<td>" . $row['proofreader'] . "</td>";
                echo "<td>" . $row['proofdate'] . "</td>";
               if($row['state'] == 0)
                    {
                        echo "<td><form action='proofdown.php' method='post'>";
                        echo "<input type='hidden' name=filename value='" . $row['filename'] . "' />";
                        echo "<input type='submit' value='领取' />";
                        echo "</form></td>";
                    }
                elseif($row['state'] == 1 && $row['proofreader'] == $user)
                    {
                         echo "<td><form action='upload_file.php' method='post'>";
                         echo "<input type='hidden' name=filename value='" . $row['filename'] . "' />";
                         echo "<input type='hidden' name=type value='proofread'/>";
                         echo "<input type='submit' value='点击提交' />";
                         echo "</form></td>";
                    }
                else
                    echo "<td>不能领取</td>";
                echo "</tr>";
            }
        echo "</table>";
    }
else
    echo "please login!";
?>
</html>