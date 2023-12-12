<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="backe-template.css">
    <?php include("../diving/css.php") ?>
</head>

<body>
<div class="container-fluid">
    <main class="row">
        <nav class="main-nav col-lg-2 p-0">
            <h1 class="my-4 text-center">DiVING</h1>
            <ul class="main-ul list-unstyle p-0">
                <li class="main-li"><a href=""><i class="bi bi-intersect"></i>總覽</a></li>
                <li class="main-li"><a href=""><i class="bi bi-file-text"></i>訂單管理</a></li>
                <li class="main-li"><a href="product-list.php"><i class="bi bi-bag-fill"></i>商品及分類</a></li>
                <li class="main-li"><a href=""><i class="bi bi-person-circle"></i>顧客管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-tv"></i>課程管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-person-vcard"></i>教練管理</a></li>
                <li class="main-li"><a href=""><i class="bi bi-shop-window"></i>行銷</a></li>
                <li class="main-li"><a href=""><i class="bi bi-megaphone"></i>公告</a></li>
            </ul>
        </nav>

        <div class="col-10 px-0" style="margin-left: 16.66%;">
            <div class="main-top">
                <a href="" class=""><i class="bi bi-box-arrow-in-right"></i>LOG OUT</a>
            </div>

    <div class="container">
        <form action="doAddProduct.php" method="post" enctype="multipart/form-data">
            <h1 class="text-center p-3">新增商品</h1>

            <!-- 返回商品列表按鈕 -->
            <div class="p-3 d-flex text-white justify-content-end">
                <a href="product-list.php" id="btn"  class="btn" title="返回商品列表"><i class="bi bi-bag-x-fill"></i></a>
            </div>

            <!-- 每一個欄位 -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">商品名稱</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="輸入商品名稱" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">規格</label>
                <input type="text" class="form-control" id="size" name="size" placeholder="輸入商品規格" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">數量</label>
                <input type="text" class="form-control" id="count" name="count" placeholder="輸入商品數量">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">價格</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="輸入商品價格" required>
            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">商品描述</label>
                <textarea class="form-control" name="info" id="info" placeholder="輸入商品描述" cols="10" rows="10" required></textarea>
            </div>

            <!-- 商品圖片 -->
            <div class="input-group mt-3">
                <input type="file" id="file" name="file" class="form-control">
                <label class="input-group-text">上傳圖片</label>
            </div>


            <!-- 確定送出按鈕 -->
            <div class="p-5 d-flex justify-content-center">
                <button id="btn"  class="btn" type="submit">確定</button>
            </div>
        </form>
    </div>
    <!-- 內容 -->
    </div>
    </main>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>