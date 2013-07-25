<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
 require_once 'head.php';
$filename=$_POST["filename"];
$user=$_SESSION["user"];
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
                echo "上传文件不能超过原文件2倍大小！";
                echo "当前文件大小: " . $_FILES["file"]["size"] . "bytes<br />";
            }
        else
            {
                if ($_FILES["file"]["error"] > 0)
                    {
                        echo "上传错误，请返回给J3如下信息: " . $_FILES["file"]["error"] . "<br />";
                    }
                else
                    {
                        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                        echo "Type: " . $_FILES["file"]["type"] . "<br />";
                        echo "Size: " . $_FILES["file"]["size"] . "bytes<br />";
                        if (file_exists($uploadpath . $_FILES["file"]["name"]))
                            {
                                echo $_FILES["file"]["name"] . "已经存在，如有疑问请联系J3. ";
                            }
                        else
                            {
                                $result=move_uploaded_file($_FILES["file"]["tmp_name"],$uploadpath . $_FILES["file"]["name"]);
                                echo "已存储到: " . $uploadpath . $_FILES["file"]["name"];
                                echo "<br/>";
                                if($result==true)
                                    {
                                    echo "上传成功<br/>";
                                    switch($type)
                                        {
                                        case 'translate':
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
                                            break;
                                        case 'proofread':
                                            $proofdate=date("Y-m-d");
                                            updata('proofread',$filename,'state','2');
                                            updata('proofread',$filename,'proofdate',$proofdate);
                                            $translator=getdata('proofread',$filename,'translator');
                                            $transdate=getdata('proofread',$filename,'transdate');
                                            $proofreader=$user;
                                            mysql_query("INSERT INTO polish (filename, filesize, translator, transdate, proofreader, proofdate, state, polisher, polishdate) VALUES ('$filename', '$filesize','$translator', '$transdate', '$user', '$proofdate', '0', 'none', '0000-00-00')");
                                            break;
                                        case 'polish':
                                            $polishdate=date("Y-m-d");
                                            updata('polish',$filename,'state','2');
                                            updata('polish',$filename,'polishdate',$polishdate);
                                        }
                                    }
                                elseif($result==false)
                                    {
                                        echo "上传失败 请给j3反馈如下信息：<br/>";
                                        print_r(error_get_last());
                                    }
                                else
                                    echo "失败，请返回j3如下信息：<br/>upload_file_true.php line92<br/>";
                                print_r(error_get_last());

                            }
                    }
            }
    }
?>