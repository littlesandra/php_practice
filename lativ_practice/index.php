<?php
require_once 'db.inc.php'
?>

<?php
//整合特定商品類別分頁的 SQL 字串
$where = "";
if (isset($_GET['sub_cat_id'])) {
    $where = "WHERE `cat_id` = {$_GET['sub_cat_id']}";
}

//取得 products 資料表總筆數
$sqlTotal = "SELECT count(1) AS `count` FROM `products` {$where}";
$totalRows = $pdo->query($sqlTotal)->fetch()['count'];

//每頁幾筆
$numPerPage = 12;

// 總頁數，ceil()為無條件進位
$totalPages = ceil($totalRows / $numPerPage);

//目前第幾頁
$page = (isset($_GET['page']) && $_GET['page'] > 0) ? (int)$_GET['page'] : 1;

//計算分頁偏移量
$offset = ($page - 1) * $numPerPage;
/**
 * LIMIT $offset , $numPerPage
 * $page = 1, (1-1)*12 , $offset = 0
 * $page = 2, (2-1)*12 , $offset = 12
 * $page = 3, (3-1)*12 , $offset = 24
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--awesome css-->
    <link rel="stylesheet" href="css/awesome.all.min.css">
    <!--lightbox-->
    <link rel="stylesheet" href="css/lightbox.min.css">
</head>

<body>
    <div class="container-fluid">
        <!-- 放主要類別的區塊 -->
        <div class="row">
            <header class="p-3 bg-dark text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                                <use xlink:href="#bootstrap"></use>
                            </svg>
                        </a>
                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                            <?php
                            $sql = "SELECT `id`, `cat_name` FROM `categories` WHERE `parent_id` = 0";
                            $arr = $pdo->query($sql)->fetchAll();
                            foreach ($arr as $obj) {
                                // echo "<li><a href=\"#\" class=\"nav-link px-2 text-white\">{$obj['cat_name']}</a></li>";
                            ?>
                                <li><a href="index.php?cat_id=<?= $obj['id'] ?>" class="nav-link px-2 text-white"><?= $obj['cat_name'] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>

                        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                            <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                        </form>
                        <div class="text-end">
                            <button type="button" class="btn btn-outline-light me-2">Login</button>
                            <button type="button" class="btn btn-warning">Sign-up</button>
                        </div>
                    </div>
                </div>
            </header>
        </div>

        <div class="row">
            <!-- 放次要類別的區塊 -->
            <div class="col-2">
                <?php if (isset($_GET['cat_id'])) { ?>
                    <ul class="nav flex-column">
                        <?php
                        $sql = "SELECT `id`, `cat_name` FROM `categories` WHERE `parent_id` = {$_GET['cat_id']}";
                        $arr1 = $pdo->query($sql)->fetchAll();
                        foreach ($arr1 as $obj1) {
                        ?>
                            <li class="nav-item">
                                <?= $obj1['cat_name'] ?>

                                <ul class="nav flex-column">
                                    <?php
                                    $sql = "SELECT `id`, `cat_name` FROM `categories` WHERE `parent_id` = {$obj1['id']}";
                                    $arr2 = $pdo->query($sql)->fetchAll();
                                    foreach ($arr2 as $obj2) {
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="index.php?cat_id=<?= $_GET['cat_id'] ?>&sub_cat_id=<?= $obj2['id'] ?>"><?= $obj2['cat_name'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php } ?>
            </div>

            <!-- 放商品一覽跟分頁連結的區塊 -->
            <div class="col-10">
                <!--商品一覽-->
                <div class="row">

                    <?php if (isset($_GET['sub_cat_id'])) { ?>
                        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                            <?php
                            $sql = "SELECT * 
                            FROM `products` 
                            WHERE `cat_id` = {$_GET['sub_cat_id']}
                            LIMIT {$offset}, {$numPerPage}";
                            $arr = $pdo->query($sql)->fetchAll();
                            foreach ($arr as $obj) {
                            ?>
                                <div class="col">
                                    <div class="card" style="width: 18rem;">
                                        <img src="<?= $obj['prod_thumbnail'] ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $obj['prod_name'] ?></h5>
                                            <p class="card-text">NT.<?= $obj['prod_price'] ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        </div>

                        <!--分頁-->
                        <div class="row">
                            <?php
                            if (isset($_GET['cat_id']) && isset($_GET['sub_cat_id'])) {
                            ?>
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <?php
                                        //列出所有分頁連結
                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            //當「目前第幾頁」($page)等於準備顯示在網頁上的分頁號碼($i)，以加上 class
                                            $strClass = '';
                                            if ($page === $i) $strClass = 'active';
                                        ?>
                                            <li class="<?= $strClass ?>">
                                                <a class="page-link" href="index.php?cat_id=<?= $_GET['cat_id'] ?>&sub_cat_id=<?= $_GET['sub_cat_id'] ?>&page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            <?php } ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!--Jquery CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!--awesome js-->
<script src="js/awesome.all.min.js"></script>
<!--lightbox js-->
<link rel="stylesheet" href="js/lightbox.min.js">

</html>