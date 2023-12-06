<?php
require_once("product-db-connect.php");


if(!isset($_POST["name"])){
    echo "請從正確管道進入";
    exit;
}

$id=$_POST["id"]; 
$name=$_POST["name"];
$size=$_POST["size"];
$count=$_POST["count"];
$price=$_POST["price"];
$info=$_POST["info"];
$fileName=$_FILES["file"]["name"];



$sql="UPDATE product SET name='$name',size='$size', count='$count',price='$price',info='$info', img='$fileName', valid=1 WHERE id=$id";





if($_FILES["file"]["error"]==0){
    move_uploaded_file($_FILES["file"]["tmp_name"], "../diving-images/".$_FILES["file"]["name"]);
    echo "上傳成功";

}else{
    echo "上傳失敗";
}


if($conn->query($sql) === TRUE){
    echo "更新成功";
}else{
    echo "更新資料錯誤: " . $conn->error;
}


$conn->close();

header("location: product-list.php?product_id=$id");