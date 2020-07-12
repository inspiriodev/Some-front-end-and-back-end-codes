<?php
function checkFileType($files){
    $pass=['image/gif','image/jpeg','image/png','image/bmp','image/jpg'];
    if (in_array($files["file"]["type"],$pass)&&$_FILES["file"]["size"]<1048576){
        return true;
    }
    return false;
}
if (checkFileType($_FILES)){
    if ($_FILES["file"]["error"]>0){
        echo "上传失败,错误:".$_FILES["file"]["error"]."<br/>";
    }
    else{
        if (file_exists("./upload/".$_FILES["file"]["name"])){
            echo "文件已存在";
        }
        else{
            move_uploaded_file($_FILES["file"]["tmp_name"],"./upload/".$_FILES["file"]["name"]);
            echo "文件上传成功，请通过<a href=\"upload/";
            echo $_FILES["file"]["name"];
            echo "\">链接</a>查看：".$_FILES["file"]["name"];
        }
    }
}
else{
    echo "文件不符合要求，仅限于上传jpg、png、jpeg、bmp、gif文件，且大小不大于2MB";
}
?>