<?php
require_once("product-db-connect.php");

if(!isset($_GET["product_id"])){ 
    header("location: product-list.php"); 
}

$id=$_GET["product_id"]; 

$sql="SELECT * FROM product WHERE product_id=$id";
$result=$conn->query($sql);

$row=$result->fetch_assoc();
?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include("../diving/css.php") ?>
</head>

<body>
    <div class="container">
        <form action="doEditProduct.php" method="post">
            <h1 class="text-center p-3">修改商品內容</h1>
            

            <!-- 返回商品列表按鈕 -->
            <div class="p-3 d-flex text-white justify-content-end">
                <a href="product-list.php" class="btn btn-primary"><i class="bi bi-bag-x-fill"></i></a>
            </div>

            <!-- 每一個欄位 -->
            <input type="hidden" name="product_id" value="<?=$row["product_id"]?>">

            <div class="mb-3">
                <label for="product_name" class="form-label">商品名稱</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $row["product_name"]?>">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">規格</label>
                <input type="text" class="form-control" id="product_size" name="product_size" value="<?= $row["product_size"]?>">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">數量</label>
                <input type="text" class="form-control" id="product_count" name="product_count" value="<?= $row["product_count"]?>">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">價格</label>
                <input type="text" class="form-control" id="product_price" name="product_price" value="<?= $row["product_price"]?>">
            </div>

            <!-- <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">商品描述</label>
                <input type="text" class="form-control" id="product_info" name="product_info" value="<?= $row["product_info"]?>">
            </div> -->

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">商品描述</label>
                <textarea class="form-control" name="product_info" id="product_info" cols="10" rows="10" required><?=$row["product_info"]?></textarea>
            </div>

            <!-- 商品圖片 -->
            <div class="input-group mt-3">
                <input type="file" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">上傳圖片</label>
            </div>

            <!-- 確定送出按鈕 -->
            <div class="p-5 d-flex justify-content-center">
                <button class="btn btn-warning text-white" type="submit">確定</button>
            </div>
        </form>

    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>