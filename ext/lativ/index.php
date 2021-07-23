<?php require_once 'db.inc.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- awesome css -->
    <link href="css/awesome.all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <header class="p-3 bg-dark text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                        </a>

                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <?php
                            $sql = "SELECT `id`, `cat_name` FROM `categories` WHERE `parent_id` = 0";
                            $arr = $pdo->query($sql)->fetchAll();
                            foreach($arr as $obj){
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
            <div class="col-2">
            <?php if(isset($_GET['cat_id'])) { ?>
                <ul class="nav flex-column">
                    <?php
                        $sql = "SELECT `id`, `cat_name` FROM `categories` WHERE `parent_id` = {$_GET['cat_id']}";
                        $arr1 = $pdo->query($sql)->fetchAll();
                        foreach($arr1 as $obj1){
                    ?>
                    <li class="nav-item">
                        <?= $obj1['cat_name'] ?>
                        <ul class="nav flex-column">
                        <?php
                            $sql = "SELECT `id`, `cat_name` FROM `categories` WHERE `parent_id` = {$obj1['id']}";
                            $arr2 = $pdo->query($sql)->fetchAll();
                            foreach($arr2 as $obj2){
                        ?>
                            <a class="nav-link" href="index.php?cat_id=<?= $_GET['cat_id'] ?>&sub_cat_id=<?= $obj2['id'] ?>"><?= $obj2['cat_name'] ?></a>
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
            <div class="col-10">
            <?php if(isset($_GET['sub_cat_id'])) { ?>
                <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                <?php
                    $sql = "SELECT `id`, `prod_name`, `prod_thumbnail`, `prod_price` FROM `products` WHERE `cat_id` = {$_GET['sub_cat_id']}";
                    $arr = $pdo->query($sql)->fetchAll();
                    foreach($arr as $obj){
                ?>
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <a href="detail.php?cat_id=<?= $_GET['cat_id'] ?>&prod_id=<?= $obj['id'] ?>"><img src="<?= $obj['prod_thumbnail'] ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title"><?= $obj['prod_name'] ?></h5>
                                <p class="card-text">價格: <?= $obj['prod_price'] ?></p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>





    

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- awesome js -->
    <script src="js/awesome.all.min.js"></script>
</body>
</html>