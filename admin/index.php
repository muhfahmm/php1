<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
require '../db.php';
$category = mysqli_query($db, "SELECT * FROM tb_category");
$countcategory = mysqli_num_rows($category);

$product = mysqli_query($db, "SELECT * FROM tb_product");
$countproduct = mysqli_num_rows($product);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Home</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <style>
        .kotak {
            border: 1px solid black;
        }

        .product-category-one {
            background-color: #38b561;
            border-radius: 8px;
        }

        .product-category-two {
            background-color: #0661f3;
            border-radius: 8px;
        }

        .underscore-text {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php
    require 'navbar.php';
    ?>
    <section class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="underscore-text"><i class="fa-solid fa-house"></i> Home</a>
                </li>
            </ol>
        </nav>
        <h1>Selamat Datang Admin <?php echo $_SESSION['username'] ?></h1>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-12 mb-3">
                    <div class="product-category-two p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-list fa-5x"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Category</h3>
                                <p class="fs-5"><?php echo $countcategory ?> kategori</p>
                                <p><a href="category.php" class="text-white underscore-text"><i class="bi bi-list-check"></i> lihat detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-3">
                    <div class="product-category-one p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-cart-flatbed fa-5x"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Product</h3>
                                <p class="fs-5"><?php echo $countproduct ?> produk</p>
                                <p><a href="product.php" class="text-white underscore-text"><i class="bi bi-list-check"></i> lihat detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>