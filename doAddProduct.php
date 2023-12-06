<?php
require_once("product-db-connect.php");



$name=$_POST["name"];
$size=$_POST["size"];
$count=$_POST["count"];
$price=$_POST["price"];
$info=$_POST["info"];
$fileName=$_FILES["file"]["name"]; //file==輸入類型;name==檔案名稱
date_default_timezone_set("Asia/Taipei"); 
$time=date('Y-m-d H:i:s');


//var_dump($product_name,$product_size,$product_count,$product_price,$product_info,$fileName);


if(!isset($_POST["name"]) || empty($_POST["name"]) ||
   !isset($_POST["size"]) || empty($_POST["size"]) ||
   !isset($_POST["count"]) || empty($_POST["count"]) ||
   !isset($_POST["price"]) || empty($_POST["price"]) ||
   !isset($_POST["info"]) || empty($_POST["info"])) {
    echo "請輸入正確資料";
    die;
}


$sql = "INSERT INTO product (name, size, count, price, info, created_at, valid, img)
VALUES ('$name', '$size', '$count', '$price', '$info', '$time', 1, '$fileName')";


if($_FILES["file"]["error"]==0){
    move_uploaded_file($_FILES["file"]["tmp_name"], "../diving-images/".$_FILES["file"]["name"]);
    echo "上傳成功";
}else{
    echo "上傳失敗";
}


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成";
    $last_id = $conn->insert_id;
    echo "最新一筆為序號".$last_id; 
} else {
    echo "新增資料錯誤: " . 
    $conn->error;
}

$conn->close();

header("location: product-list.php");