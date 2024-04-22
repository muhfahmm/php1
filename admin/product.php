<?php

require '../db.php';
$result = mysqli_query($db, "SELECT * FROM tb_product");
$count = mysqli_num_rows($result);

$queryCategory = mysqli_query($db, "SELECT * FROM tb_category");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Admin</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <style>
        .underscore-text {
            text-decoration: none;
        }

        form div {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php require 'navbar.php' ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="underscore-text text-muted"><i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="category.php" class="underscore-text text-muted"><i class="fa-solid fa-list fa"></i> Category</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="product.php" class="underscore-text"><i class="fa-solid fa-cart-flatbed fa"></i> Product</a>
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">nama</label>
                    <input type="text" name="nama" id="nama" class="form-control mb-10" placeholder="nama produk" autocomplete="off">
                </div>
                <div>
                    <label for="category">pilih kategori</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">pilih barang</option>
                        <?php
                        while ($data = mysqli_fetch_assoc($queryCategory)) {
                        ?>
                            <option value="<?php echo $data['id'] ?>"><?php echo $data['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">harga</label>
                    <input type="number" class="form-control" name="harga">
                </div>
                <div>
                    <label for="foto">foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">detail</label>
                    <textarea name="detail" id="detail" cols="0" rows="0" class="form-control"></textarea>
                </div>
                <div>
                    <label for="stock">stock barang</label>
                    <select name="stock" id="stock" class="form-control">
                        <option value="tersedia">tersedia</option>
                        <option value="habis">habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" name="save" class="btn btn-primary"><i class="bi bi-floppy"></i> simpan</button>
                </div>
            </form>
            <?php
            if (isset($_POST['save'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $category = htmlspecialchars($_POST['category']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $stock = htmlspecialchars($_POST['stock']);

                $target_dir = "../img/";
                $file_name = basename($_FILES['foto']['name']);
                $target_file = $target_dir . $file_name;
                $img_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $img_size = $_FILES['foto']['size'];

                if ($nama == '' || $category == '' || $harga == '') {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        kolom yang kosong wajib diisi!
                    </div>
                    <?php
                } else {
                    if ($file_name != '') {
                        if ($img_size > 200000) {
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                file tidak boleh lebih dari 200kb!
                            </div>
                            <?php
                        } else {
                            if ($img_type != 'jpg' && $img_type != 'png' && $img_type != 'svg') {
                            ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    file wajib bertipe jpg, png atau svg!
                                </div>
            <?php
                            } else {
                                move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
                            }
                        }
                    }
                }
            }
            ?>
        </div>
        <div class="mt-3">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($count == 0) {
                        ?>
                            <tr>
                                <td colspan=5 class="text-center pt-4 pb-4">data produk kosong</td>
                            </tr>
                            <?php
                        } else {
                            $i = 1;
                            while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['category_id'] ?></td>
                                    <td><?php echo $data['harga'] ?></td>
                                    <td><?php echo $data['stock'] ?></td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>