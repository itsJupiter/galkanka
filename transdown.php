<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$filename = $_POST['filename'];
$user = $_POST['user'];
echo "已经成功领取，";
echo "<a href='./original/" . $filename . ".txt'>请右击另存为</a>";
$con = mysql_connect("localhost","root","chinaman");
if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
mysql_select_db("galkanka", $con);
$date=date("Y-m-d");
mysql_query("UPDATE translate SET state = '1' WHERE filename = '$filename'");
mysql_query("UPDATE translate SET translator = '$user' WHERE filename = '$filename'");
mysql_query("UPDATE translate SET transdate = '$date' WHERE filename = '$filename'");
mysql_close($con);
?>