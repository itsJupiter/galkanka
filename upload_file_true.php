<?php
$filename=$_POST["filename"];
$user=$_POST["user"];
$type=$_POST["type"];
switch($type)
    {
    case 'translate':$uploadpath="translated/";break;
    case 'proofread':$uploadpath="proofreaded/";break;
    case 'polish':$uploadpath="done/";break;
    }

if(($filename . ".txt") !=$_FILES["file"]["name"])
    {
        echo "请选择" . $filename . ".txt文件！<br/>";
    }
else
    {
        $con = mysql_connect("localhost","root","chinaman");//连接数据库,mysql_connect的三个参数分别为数据库地址(一般为localhost)，帐户、和密码
        if (!$con)
            {
                die('Could not connect: ' . mysql_error());
            }//如果连接失败则报错
        mysql_select_db("galkanka", $con);//选择数据库，这里是galkanka
        $temp=mysql_query("SELECT * FROM $type WHERE filename='$filename'");
        $row = mysql_fetch_array($temp);
        $filesize=$row["filesize"];
        if ($_FILES["file"]["type"] != "text/plain")
            {
                echo "喂你至少上传个txt文件啊";
            }
        elseif($_FILES["file"]["size"] > 2*$row["filesize"])
            {
                echo "你这文件太大了吧。。";
            }
        else
            {
                if ($_FILES["file"]["error"] > 0)
                    {
                        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                    }
                else
                    {
                        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                        echo "Type: " . $_FILES["file"]["type"] . "<br />";
                        echo "Size: " . $_FILES["file"]["size"] . "bytes<br />";
                        if (file_exists($uploadpath . $_FILES["file"]["name"]))
                            {
                                echo $_FILES["file"]["name"] . " already exists. ";
                            }
                        else
                            {
                                $result=move_uploaded_file($_FILES["file"]["tmp_name"],$uploadpath . $_FILES["file"]["name"]);
                                echo "Stored in: " . $uploadpath . $_FILES["file"]["name"];
                                echo "<br/>";
                                if($result==true)
                                    {
                                    echo "上传成功<br/>";
                                    if($type=='translate')
                                        {
                                            $date=date("Y-m-d");
                                            mysql_query("UPDATE translate SET state = '2',transdate='$date' WHERE filename = '$filename'");
                                            mysql_query("INSERT INTO proofread (filename, filesize, translator, transdate, state, proofreader, proofdate) VALUES ('$filename', '$filesize', '$user', '$date', '0', 'none', '0000-00-00')");
                                            echo "数据库更新完成";
                                            echo "<br/>";
                                            echo "请概括本文内容，不超过94个字。";
                                            echo "<form action='upinfo.php' method='post'>";
                                            echo "<input type='text' name=info value='' />";
                                            echo "<input type='hidden' name=filename value='" . $filename . "' />";
                                            echo "<input type='submit' value='提交'/>";
                                            echo "</form>";
                                        }
                                    }
                                elseif($result==false)
                                    {
                                        echo "false<br/>";
                                        print_r(error_get_last());
                                    }
                                else
                                    echo "fuck";

                            }
                    }
            }
    }
?>