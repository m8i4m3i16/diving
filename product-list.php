<?php
require_once("product-db-connect.php");

$sqlTotal = " SELECT * FROM product WHERE valid=1";
$resultTotal = $conn->query($sqlTotal);
$totalProduct = $resultTotal->num_rows;
$perPage = 6;
$pageCount = ceil($totalProduct / $perPage);


if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM product WHERE 
            name LIKE '%$search%' OR 
            size LIKE '%$search%' OR 
            count LIKE '%$search%' OR 
            price LIKE '%$search%' OR 
            info LIKE '%$search%' AND valid=1";
} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
    $page = $_GET["page"];
    $order = $_GET["order"];
    switch ($order) {
        case 1:
            $orderSql = "price ASC";
            break;
        case 2:
            $orderSql = "price DESC";
            break;
        case 3:
            $orderSql = "id ASC";
            break;
        case 4:
            $orderSql = "id DESC";
            break;
        default:
            $orderSql = "id ASC";
    }

    $startItem = ($page - 1) * $perPage;

    $sql = "SELECT * FROM product WHERE valid=1 ORDER BY $orderSql LIMIT $startItem,$perPage";
} else {
    $page = 1;
    $order = 1;
    $sql = "SELECT * FROM product WHERE valid=1 ORDER BY id ASC LIMIT 0,$perPage";
}

$result = $conn->query($sql);

?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="backe-template.css">
    <?php include("../diving/css.php") ?>
    <style>
        .object-fit-cover {
            width: 100px;
            height: 100px;
            object-fit: cover;
            /* position: fixed;
            z-index: 1000; */
        }

        .pagination li {
            background-color: #c3c3c3;
            color: #437281;
        }
    </style>


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
                <!-- 內容 -->
                <div class="container">
                    <form action="">
                        <h1 class="text-center p-3">商品列表</h1>

                        <div class="p-3 d-flex justify-content-between">
                            <!-- 抓資料庫中的產品數量 -->
                            <?php $productCount = $resultTotal->num_rows; ?>
                            <div class="py-2 total-count">
                                共 <?= $productCount ?> 筆產品
                            </div>
                            <!-- 抓資料庫中的產品數量 -->
                            <!-- 新增商品button -->
                            <a href="add-product.php" id="btn" class="btn" title="新增商品"><i class="bi bi-bag-plus-fill"></i></a>
                        </div>


                        <!-- 搜尋 -->
                        <?php if (isset($_GET["search"])) {
                            echo "搜尋 {$_GET["search"]} 的結果 ";
                        } ?>
                        <?php if (isset($_GET["search"])) : ?>
                            <a href="product-list.php" id="btn" class="btn"><i class="bi bi-arrow-counterclockwise"></i></a>
                            <!-- 搜尋 <?= $_GET["search"] ?> 的結果, -->
                        <?php endif; ?>

                        <div class="py-1">
                            <form action="">
                                <div class="input-group mb-3 px-3">
                                    <input type="text" class="form-control" placeholder="搜尋商品" name="search">
                                    <!-- 改成name="search"，會讓網址出現search的變數(會帶出關鍵字) -->
                                    <button id="btn" class="btn" type="submit" id="" title="搜尋"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <!-- 排序 -->
                        <?php if (!isset($_GET["search"])) : ?>
                            <div class="py-2 px-3">
                                <!-- 價格排序 -->
                                <a id="btn" class="btn <?php if ($order == 1) echo "active" ?>" href="product-list.php?page=<?= $page ?>&order=1"><i class="bi bi-sort-numeric-down-alt"></i></a>

                                <a id="btn" class="btn <?php if ($order == 2) echo "active" ?>" href="product-list.php?page=<?= $page ?>&order=2"><i class="bi bi-sort-numeric-down"></i></a>
                                <!-- id排序 -->
                                <a id="btn" class="btn <?php if ($order == 3) echo "active" ?>" href="product-list.php?page=<?= $page ?>&order=3"><i class="bi bi-sort-down-alt"></i></a>

                                <a id="btn" class="btn <?php if ($order == 4) echo "active" ?>" href="product-list.php?page=<?= $page ?>&order=4"><i class="bi bi-sort-down"></i></a>

                            </div>
                        <?php endif; ?>


                        <?php $rows = $result->fetch_all(MYSQLI_ASSOC); ?>
                        <!-- <pre><?php print_r($rows); ?></pre> -->
                        <div class="table-responsive">
                            <table class="table text-center my-3">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th scope="col">編號</th>
                                        <th scope="col">商品圖片</th>
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
                                                <td><?= $row["id"] ?></td>
                                                <td>
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <div class="ratio ratio-1x1 object-fit-cover">
                                                            <img class="img-fluid" src="../diving-images/<?= $row["img"] ?>" alt="產品圖片">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["info"] ?></td>
                                                <td><?= $row["size"] ?></td>
                                                <td><?= number_format($row["count"]) ?></td>
                                                <td><?= number_format($row["price"]) ?></td>
                                                <td><?= $row["created_at"] ?></td>

                                                <td class="text-nowrap">
                                                    <a id="btn" class="btn" href="edit-prodict.php?id=<?= $row["id"] ?>" title="編輯商品"><i class="bi bi-pencil-square"></i></a>
                                                    <!-- Button trigger modal -->
                                                    <!-- 刪除版本 -->
                                                    <button type="button" id="btn" class="btn" data-bs-toggle="modal" data-bs-target="#deleteproduct<?= $row["id"] ?>"><i class="bi bi-trash3" title="刪除商品"></i></button>

                                                    <!-- 上下架版本 -->
                                                    <!-- <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteproduct<?= $row["product_id"] ?>"><i class="bi bi-cart-plus-fill" title="上架商品"></i></button>
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteproduct<?= $row["product_id"] ?>"><i class="bi bi-cart-dash" title="下架商品"></i></button> -->
                                                    <!-- 上下架版本 -->
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteproduct<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">刪除</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    確定要刪除此筆商品？
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                                    <a id="btn" class="btn" href="doDeleteProduct.php?id=<?= $row["id"] ?>">刪除</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                </tbody>
                            </table>
                    </form>
                </div>

                <!-- 分頁 -->
                <?php if (!isset($_GET["search"])) : ?>

                    <div class="py-5 d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul id="pagination" class="pagination pagination-sm">

                                <!-- 使用for，讓li可以一直跑出迴圈 -->
                                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>

                                    <li id="page-item" class="page-item  <?php if ($page == $i) echo "active"; ?>">
                                        <!-- <?php if ($page == $i) echo "active"; ?>是樣式 -->
                                        <a id="btn" class="page-link" href="product-list.php?page=<?= $i ?>&order=<?= $order ?>"> <?= $i ?> </a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
                <!-- 分頁 -->


            <?php else : ?>
                目前無商品
            <?php endif; ?>
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