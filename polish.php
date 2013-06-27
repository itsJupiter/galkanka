<?php
if($_POST)
    {
        $user=$_POST['user'];
        echo "<h1>校对领取表</h1>";
        echo "<p>当前用户为" . $user . "</p>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>文件名</th>";
        echo "<th>文件大小</th>";
        echo "<th>翻译者</th>";
        echo "<th>翻译时间</th>";
        echo "<th>校对者</th>";
        echo "<th>校对时间</th>";
        echo "<th>当前状态</th>";
        echo "<th>润色者</th>";
        echo "<th>润色时间</th>";
        echo "<th>&nbsp;</th>";
        echo "</tr>";
//以上输出表头
//连接mysql
        $con = mysql_connect("localhost","root","chinaman");
        if (!$con)
            {
                die('Could not connect: ' . mysql_error());
            }
        mysql_select_db("galkanka", $con);
        $polish= mysql_query("SELECT * FROM polish order by filename asc");
        while($row = mysql_fetch_array($polish))
            {
                echo "<tr>";
                echo "<td>" . $row['filename'] . "</td>";
                echo "<td>" . $row['filesize'] . "</td>";
                echo "<td>" . $row['translator'] . "</td>";
                echo "<td>" . $row['transdate'] . "</td>";
                echo "<td>" . $row['proofreader'] . "</td>";
                echo "<td>" . $row['proofdate'] . "</td>";
                switch($row['state'])
                    {
                    case '0' : echo "<td>" . "未领取" . "</td>";break;
                    case '1': echo "<td>" . "正在进行" . "</td>";break;
                    case '2' : echo "<td>" . "已完成" . "</td>";break;
                    }
                echo "<td>" . $row['polisher'] . "</td>";
                echo "<td>" . $row['polishdate'] . "</td>";
                if($row['state'] == 0)
                    {
                        echo "<td><form action='polishdown.php' method='post'>";
                        echo "<input type='hidden' name=filename value='" . $row['filename'] . "' />";
                        echo "<input type='hidden' name=user value='" . $user . "' />";
                        echo "<input type='submit' value='领取' />";
                        echo "</form></td>";
                    }
                elseif($row['state'] == 1 && $row['polisher'] == $user)
                    {
                         echo "<td><form action='upload_file.php' method='post'>";
                         echo "<input type='hidden' name=filename value='" . $row['filename'] . "' />";
                         echo "<input type='hidden' name=user value='" . $row['polisher'] . "' />";
                         echo "<input type='hidden' name=type value='polish'/>";
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