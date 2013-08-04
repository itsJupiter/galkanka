<?php
$con = mysql_connect("localhost","root","chinaman");//连接数据库,mysql_connect的三个参数分别为数据库地址(一般为localhost)，帐户、和密码
if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }//如果连接失败则报错
mysql_select_db("galkanka", $con);
function getdata($type,$filename,$column)
{
    $temp=mysql_query("SELECT * FROM $type WHERE filename='$filename' ");
    $row=mysql_fetch_array($temp);
    $result=$row[$column];
    return $result;
}
function updata($type,$filename,$column,$data)
{
    mysql_query("UPDATE $type SET $column = '$data' WHERE filename = '$filename'");
    return 1;
}
function downtext($type,$filename)
{
    switch($type)
        {
        case 'proofread':$uploadpath="translated/";break;
        case 'polish':$uploadpath="proofreaded/";break;
        }
    copy($uploadpath.$filename.".txt","temp/".$filename.".txt");
    echo "请<a href='./temp/" .$filename.".txt'>右击另存为</a>，半分钟后链接失效<br/>";
    fastcgi_finish_request();
    sleep(30);
    unlink("temp/".$filename.".txt");
}
?>
