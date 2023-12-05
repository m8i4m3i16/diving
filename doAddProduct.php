<?php
require_once("product-db-connect.php");


$product_name=$_POST["product_name"];
$product_size=$_POST["product_size"];
$product_count=$_POST["product_count"];
$product_price=$_POST["product_price"];
$product_info=$_POST["product_info"];
//$product_img=$_POST["product_img"];
date_default_timezone_set("Asia/Taipei"); 
$time=date('Y-m-d H:i:s');

//var_dump($product_name,$product_size,$product_count,$product_price,$product_info);


if(!isset($_POST["product_name"]) || empty($_POST["product_name"]) ||
   !isset($_POST["product_size"]) || empty($_POST["product_size"]) ||
   !isset($_POST["product_count"]) || empty($_POST["product_count"]) ||
   !isset($_POST["product_price"]) || empty($_POST["product_price"]) ||
   !isset($_POST["product_info"]) || empty($_POST["product_info"])) {
    echo "請輸入正確資料";
    die;
}


$sql = "INSERT INTO product (product_name, product_size, product_count, product_price, product_info, created_at, valid)
VALUES ('$product_name', '$product_size', '$product_count', '$product_price', '$product_info', '$time', 1)";


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