<?php
require '../db.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

$id = $_GET['id'];
$query = mysqli_query($db, "SELECT * FROM tb_category WHERE id = '$id' ");
$data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <style>
        .underscore-text {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php require 'navbar.php' ?>
    <div class="container">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb mt-3">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="underscore-text text-muted"><i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="category.php" class="underscore-text"><i class="fa-solid fa-list fa"></i> Category</a>
                </li>
            </ol>
        </nav>
        <h2 class="mt-3">edit detail kategori</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">kategori</label>
                    <input type="text" name="category" id="kategori" class="form-control mt-3" required autocomplete="off" placeholder="" value="<?php echo $data['nama'] ?>">
                </div>
                <div class="mt-5 d-flex">
                    <button type="submit" class="btn btn-primary ms-2" name="edit">edit</button>
                    <button type="submit" class="btn btn-danger ms-2" name="delete">hapus</button>
                </div>
            </form>
            <?php
            // edit data
            if (isset($_POST['edit'])) {
                $category = htmlspecialchars($_POST['category']);
                if ($data['nama'] == $category) {
            ?>
                    <meta http-equiv="refresh" content="0; url=category.php">
                    <?php
                } else {
                    $query = mysqli_query($db, "SELECT * FROM tb_category WHERE nama='$category'");
                    $countData = mysqli_num_rows($query);
                    if ($countData > 0) {
                    ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            data sudah ada!
                        </div>
                        <?php
                    } else {
                        $querysave = mysqli_query($db, "UPDATE tb_category SET nama = '$category' WHERE id = '$id' ");
                        if ($querysave) {
                        ?>
                            <div class="alert alert-success mt-3" role="alert">
                                kategori berhasil terupdate!
                            </div>
                            <meta http-equiv="refresh" content="0; url=category.php">
                    <?php
                        } else {
                            echo mysqli_error($db);
                        }
                    }
                }
            }

            // delete data
            if (isset($_POST['delete'])) {
                $delete = mysqli_query($db, "DELETE FROM tb_category WHERE id = '$id'");
                if ($delete) {
                    
                    ?>
                    
                    <div class="alert alert-success mt-3" role="alert">
                        kategori berhasil terhapus!
                    </div>
                    <meta http-equiv="refresh" content="1; url=category.php">
            <?php
                } else {
                    echo mysqli_error($db);
                }
            }
            ?>
        </div>
    </div>
</body>

</html>