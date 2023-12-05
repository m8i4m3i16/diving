<?php
require_once("product-db-connect.php");

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM product WHERE 
            product_name LIKE '%$search%' OR 
            product_size LIKE '%$search%' OR 
            product_count LIKE '%$search%' OR 
            product_price LIKE '%$search%' OR 
            product_info LIKE '%$search%' AND valid=1";
} else {
    $sql = "SELECT * FROM product WHERE valid=1";
}


// $resultTotal = $conn->query($sqlTotal);
// $totalUser = $resultTotal->num_rows;

$result = $conn->query($sql);
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


        <form action="">
            <h1 class="text-center p-3">商品列表</h1>

            <div class="p-3 d-flex justify-content-between">
                <!-- 抓資料庫中的產品數量 -->
                <?php $productCount = $result->num_rows; ?>
                <div class="py-2">
                    共 <?= $productCount ?> 筆
                </div>
                <!-- 抓資料庫中的產品數量 -->
                <!-- 新增商品button -->
                <a href="add-product.php" class="btn btn-primary" title="新增商品"><i class="bi bi-bag-plus-fill"></i></a>
            </div>


            <!-- 搜尋 -->
            <?php if (isset($_GET["search"])) {            
                echo "搜尋 {$_GET["search"]} 的結果 ";  } ?>
            <?php if (isset($_GET["search"])) : ?>
                <a href="product-list.php" class="btn btn-primary text-white"><i class="bi bi-arrow-counterclockwise"></i></a>
                <!-- 搜尋 <?= $_GET["search"] ?> 的結果, -->
            <?php endif; ?>
            
            <div class="py-1">
                <form action="">
                    <div class="input-group mb-3 px-3">
                        <input type="text" class="form-control" placeholder="搜尋商品" name="search">
                        <!-- 改成name="search"，會讓網址出現search的變數(會帶出關鍵字) -->
                        <button class="btn btn-primary" type="submit" id="" title="搜尋"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>

            <!-- 價格排序 -->
            <div class="py-2 px-3">
                <div class="btn btn-warning"><i class="text-white bi bi-sort-numeric-down-alt"></i></div>
                <div class="btn btn-warning"><i class="text-white bi bi-sort-numeric-down"></i></div>
            </div>



            <?php $rows = $result->fetch_all(MYSQLI_ASSOC); ?>
            <!-- <pre><?php print_r($rows); ?></pre> -->
            <div class="table-responsive">
                <table class="table text-center my-3">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">編號</th>
                            <!-- <th scope="col">商品圖片</th> -->
                            <th scope="col">商品名稱</th>
                            <th scope="col">商品描述</th>
                            <th scope="col">規格</th>
                            <th scope="col">數量</th>
                            <th scope="col">價格</th>
                            <th scope="col">更新時間</th>
                            <th scope="col">設定</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($productCount > 0) : ?>
                            <?php foreach ($rows as $row) : ?>
                                <tr>
                                    <td><?= $row["product_id"] ?></td>
                                    <!-- <td>商品圖片</td> -->
                                    <td><?= $row["product_name"] ?></td>
                                    <td><?= $row["product_info"] ?></td>
                                    <td><?= $row["product_size"] ?></td>
                                    <td><?= number_format($row["product_count"]) ?></td>
                                    <td><?= number_format($row["product_price"]) ?></td>
                                    <td><?= $row["created_at"] ?></td>

                                    <td class="text-nowrap">
                                        <a class="btn btn-warning text-white" href="edit-prodict.php?product_id=<?= $row["product_id"] ?>" title="編輯商品"><i class="bi bi-pencil-square"></i></a>
                                        <!-- Button trigger modal -->
                                        <!-- 刪除版本 -->
                                        <!-- <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteproduct<?= $row["product_id"] ?>"><i class="bi bi-trash3" title="刪除商品"></i></button> -->

                                        <!-- 上下架版本 -->
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteproduct<?= $row["product_id"] ?>"><i class="bi bi-cart-plus-fill" title="上架商品"></i></button>
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteproduct<?= $row["product_id"] ?>"><i class="bi bi-cart-dash" title="下架商品"></i></button>
                                        <!-- 上下架版本 -->
                                        <!-- Modal -->
                                        <!-- 上架 -->
                                        <div class="modal fade" id="deleteproduct<?= $row["product_id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">上架商品通知</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        確定要上架此筆商品？
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                        <a class="btn btn-danger text-white" href="doDeleteProduct-1.php?product_id=<?= $row["product_id"] ?>">上架商品</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 下架 -->
                                        <div class="modal fade" id="deleteproduct<?= $row["product_id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">下架商品通知</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        確定要下架此筆商品？
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                        <a class="btn btn-danger text-white" href="doDeleteProduct.php?product_id=<?= $row["product_id"] ?>">下架商品</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            目前無使用者
                        <?php endif; ?>
                    </tbody>
                </table>
        </form>
    </div>
    </div>

    <!-- 分頁 -->
    <div class="py-5 d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm">
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>