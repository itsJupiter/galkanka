<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<?php
require_once 'head.php';
if($_POST)
    {
        $user=$_POST['user'];
        echo "<h1>翻译领取表</h1>";
        echo "<p>当前用户为" . $user . "</p>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>文件名</th>";
        echo "<th>文件大小</th>";
        echo "<th>当前状态</th>";
        echo "<th>翻译者</th>";
        echo "<th>翻译时间</th>";
        echo "<th>&nbsp;</th>";
        echo "<th>大致内容</th>";
        echo "</tr>";
        $translate= mysql_query("SELECT * FROM translate order by filename asc");//从translate表中读取数据，并以filename列按ascii(大概)排序
        while($row = mysql_fetch_array($translate))//mysql_fetch_array函数调用时返回其参数的变量中的一组数据，每调用一次返回下一个数据
            {
                echo "<tr>";
                echo "<td>" . $row['filename'] . "</td>";
                echo "<td>" . $row['filesize'] . "</td>";
                switch($row['state'])
                    {
                    case '0' : echo "<td>" . "<font color='red'>未领取</font>" . "</td>";break;
                    case '1': echo "<td>" . "<font color='blue'>正在进行</font>" . "</td>";break;
                    case '2' : echo "<td>" . "<font color='green'>已完成</font>" . "</td>";break;
                    }
                echo "<td>" . $row['translator'] . "</td>";
                echo "<td>" . $row['transdate'] . "</td>";
                if($row['state'] == 0)
                    {
                        echo "<td><form action='transdown.php' method='post'>";
                        echo "<input type='hidden' name=filename value='" . $row['filename'] . "' />";
                        echo "<input type='hidden' name=user value='" . $user . "' />";
                        echo "<input type='submit' value='领取' />";
                        echo "</form></td>";
                    }
                elseif($row['state'] == 1 && $row['translator'] == $user)
                    {
                         echo "<td><form action='upload_file.php' method='post'>";
                         echo "<input type='hidden' name=filename value='" . $row['filename'] . "' />";
                         echo "<input type='hidden' name=user value='" . $row['translator'] . "' />";
                         echo "<input type='hidden' name=type value='translate'/>";
                         echo "<input type='submit' value='点击提交' />";
                         echo "</form></td>";
                    }
                else
                    echo "<td>不能领取</td>";
                echo "<td>" . $row['info'] . "</td>";
                echo "</tr>";
            }
        echo "</table>";
    }
else
    echo "please login!";
?>
</html>