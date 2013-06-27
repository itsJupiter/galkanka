<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<?php
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
        echo "</tr>";
//以上输出表头
//连接mysql
        $con = mysql_connect("localhost","root","chinaman");//连接数据库,mysql_connect的三个参数分别为数据库地址(一般为localhost)，帐户、和密码
        if (!$con)
            {
                die('Could not connect: ' . mysql_error());
            }//如果连接失败则报错
        mysql_select_db("galkanka", $con);//选择数据库，这里是galkanka
        $translate= mysql_query("SELECT * FROM translate order by filename asc");//从translate表中读取数据，并以filename列按ascii(大概)排序
        while($row = mysql_fetch_array($translate))//mysql_fetch_array函数调用时返回其参数的变量中的一组数据，每调用一次返回下一个数据
            {
                echo "<tr>";
                echo "<td>" . $row['filename'] . "</td>";
                echo "<td>" . $row['filesize'] . "</td>";
                switch($row['state'])
                    {
                    case '0' : echo "<td>" . "未领取" . "</td>";break;
                    case '1': echo "<td>" . "正在进行" . "</td>";break;
                    case '2' : echo "<td>" . "已完成" . "</td>";break;
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
                echo "</tr>";
            }
        echo "</table>";
    }
else
    echo "please login!";
?>
</html>