<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
 require_once 'head.php';
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
        $filesize=getdata($type,$filename,'filesize');
        /*if ($_FILES["file"]["type"] != "text/plain")
            {
                echo "喂你至少上传个txt文件啊";
                echo "Type: " . $_FILES["file"]["type"] . "<br />";
                }*/
        if($_FILES["file"]["size"] > 2*$filesize)
            {
                echo "你这文件太大了吧。。";
                echo "当前文件大小: " . $_FILES["file"]["size"] . "bytes<br />";
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
                                            updata('translate',$filename,'state','2');
                                            updata('translate',$filename,'transdate',$date);
                                            mysql_query("INSERT INTO proofread (filename, filesize, translator, transdate, state, proofreader, proofdate) VALUES ('$filename', '$filesize', '$user', '$date', '0', 'none', '0000-00-00')");
                                            echo "数据库更新完成";
                                            echo "<br/>";
                                            echo "请概括本文内容，方便其它翻译对照上下文，不要超过94个字。";
                                            echo "<form action='upinfo.php' method='post'>";
                                            echo "<input type='text' name=info value='' />";
                                            echo "<input type='hidden' name=filename value='" . $filename . "' />";
                                            echo "<input type='submit' value='提交'/>";
                                            echo "</form>";
                                        }
                                    }
                                elseif($result==false)
                                    {
                                        echo "上传失败 请给j3反馈如下信息：<br/>";
                                        print_r(error_get_last());
                                    }
                                else
                                    echo "fuck";

                            }
                    }
            }
    }
?>