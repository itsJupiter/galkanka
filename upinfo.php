<?php
$info=$_POST['info'];
$filename=$_POST['filename'];
$con = mysql_connect("localhost","root","chinaman");
if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
mysql_select_db("galkanka", $con);
mysql_query("UPDATE translate SET info='$info' WHERE filename='$filename'");
echo "succeed";
?>