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
        <form action="doAddProduct.php" method="post" enctype="multipart/form-data">
            <h1 class="text-center p-3">新增商品</h1>

            <!-- 返回商品列表按鈕 -->
            <div class="p-3 d-flex text-white justify-content-end">
                <a href="product-list.php" class="btn btn-primary"title="返回商品列表"><i class="bi bi-bag-x-fill"></i></a>
            </div>

            <!-- 每一個欄位 -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">商品名稱</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="輸入商品名稱" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">規格</label>
                <input type="text" class="form-control" id="product_size" name="product_size" placeholder="輸入商品規格" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">數量</label>
                <input type="text" class="form-control" id="product_count" name="product_count" placeholder="輸入商品數量">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">價格</label>
                <input type="text" class="form-control" id="product_price" name="product_price" placeholder="輸入商品價格" required>
            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">商品描述</label>
                <textarea class="form-control" name="product_info" id="product_info" placeholder="輸入商品描述" cols="10" rows="10" required></textarea>
            </div>

            <!-- 商品圖片 -->
            <div class="input-group mt-3">
                <input type="file" id="file" name="file" class="form-control">
                <label class="input-group-text">上傳圖片</label>
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