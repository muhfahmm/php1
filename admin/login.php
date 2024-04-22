<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: index.php");
}
require '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <form action="" method="post">
        <div class="login-container flex-column" id="container">
            <div class="login-wrapper shadow">
                <h1>Login</h1>
                <div class="login-input">
                    <input type="text" name="username" placeholder="username" autocomplete="off" required>
                </div>
                <div class="login-input">
                    <input type="password" name="password" placeholder="password" autocomplete="off" required>
                </div>
                <div class="login-btn">
                    <button type="submit" name="login">Login</button>
                </div>
                <?php
                if (isset($_POST['login'])) {
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($db, "SELECT * FROM tb_admin WHERE username = '$username' ");
                    $result = mysqli_num_rows($query);
                    $data = mysqli_fetch_assoc($query);

                    if ($result > 0) {
                        if (password_verify($password, $data['password'])) {
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header("Location: ../admin");
                        }
                    } else {
                ?>
                        <div class="alert alert-warning" role="alert">
                            user belum terdaftar
                        </div>
                <?php
                    }
                }
                ?>
                <div class="regist-link d-flex">
                    <p>belum punya akun admin? <a href="register.php">daftar</a></p>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <div class="">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-sun-fill theme-icon-active" data-theme-icon-active="sun-fill"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="light">
                                            <i class="bi bi-sun-fill me-2 opacity-50" data-theme-icon="bi bi-sun-fill"></i>
                                            Terang
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="dark">
                                            <i class="bi bi-moon-fill me-2 opacity-50" data-theme-icon="bi bi-moon-fill"></i>
                                            Gelap
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="light">
                                            <i class="bi bi-circle-half me-2 opacity-50" data-theme-icon="bi bi-circle-half"></i>
                                            Default
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <script src="./js/darkmode.js"></script>
</body>

</html>