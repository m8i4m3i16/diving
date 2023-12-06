<?php
require_once("product-db-connect.php");



if(!isset($_POST["product_name"])){
    echo "請從正確管道進入";
    exit;
}

$id=$_POST["product_id"]; 
$product_name=$_POST["product_name"];
$product_size=$_POST["product_size"];
$product_count=$_POST["product_count"];
$product_price=$_POST["product_price"];
$product_info=$_POST["product_info"];
$fileName=$_FILES["file"]["name"];


//echo $product_name;
//var_dump($id,$product_name,$product_size,$product_count,$product_price,$product_info);

$sql="UPDATE product SET product_name='$product_name',product_size='$product_size', product_count='$product_count',product_price='$product_price',product_info='$product_info',product_img='$fileName', valid=1 WHERE product_id=$id";
//var_dump($_FILES["file"]);
//echo $sql;
//var_dump($sql);


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