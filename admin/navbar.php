<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link " href="category.php">Category</a>
                    </li>
                    <li class="nav-item dropdown">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="logout.php">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                    </li>
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

                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="./js/darkmode.js"></script>
</body>

</html>