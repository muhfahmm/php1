<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

require '../db.php';
$category = mysqli_query($db, "SELECT * FROM tb_category");
$count = mysqli_num_rows($category);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
</head>
<style>
    .underscore-text {
        text-decoration: none;
    }
</style>

<body>
    <?php
    require 'navbar.php';
    ?>
    <section class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="underscore-text text-muted"><i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="category.php" class="underscore-text"><i class="fa-solid fa-list fa"></i> Category</a>
                </li>
            </ol>
        </nav>
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>
            <form action="" method="post">
                <div class="form-container d-flex">
                    <div>
                        <label for="category">Kateogri</label>
                        <input type="text" id="category" name="category" placeholder="tambah kategori barang..." class="form-control" required>
                    </div>
                    <div class="mt-4 ms-2">
                        <button class="btn btn-primary" type="submit" name="add"><i class="bi bi-plus-circle"></i> tambah</button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST['add'])) {
                $data = htmlspecialchars($_POST['category']);

                $query = mysqli_query($db, "SELECT nama FROM tb_category WHERE nama = '$data' ");
                $newcount = mysqli_num_rows($query);

                if ($newcount > 0) {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        data sudah ada!
                    </div>
                    <?php
                } else {
                    $querysave = mysqli_query($db, "INSERT INTO tb_category(nama)
                    VALUES ('$data')");
                    if ($querysave) {
                    ?>
                        <div class="alert alert-success mt-3" role="alert">
                            kategori berhasil ditambahkan!
                        </div>
                        <meta http-equiv="refresh" content="1; url=category.php">
            <?php
                    } else {
                        echo mysqli_error($db);
                    }
                }
            }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Category</h2>
        </div>
        <?php
            $category = mysqli_query($db, "SELECT * FROM tb_category");
            $count = mysqli_num_rows($category);  
        ?>
        <p class="fs-5"><?php echo $count ?> kategori</p>

        <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($count == 0) {

                    ?>
                        <tr>
                            <td colspan=3 class="text-center pt-4 pb-4">data kategori kosong</td>
                        </tr>
                        <?php
                    } else {
                        $i = 1;
                        while ($data = mysqli_fetch_array($category)) {

                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td>
                                    <a href="edit-category.php?id=<?php echo $data['id'] ?>"><i class="fa-solid fa-pen-to-square h4"></i></a>
                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>