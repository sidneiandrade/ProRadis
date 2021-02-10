<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(); 
}

if (!isset($_SESSION['usuario'])) {
    exit(header('Location: ' . $baseUrl ));
}

$id = $_SESSION['id'];

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <link rel="icon" type="image/png" sizes="16x16" href="./dist/img/favicon.png">
        <title>Administração</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>dist/notiflix/notiflix-2.4.0.min.css" />
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>dist/summernote/summernote-bs4.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl ?>dist/css/adminx.css" media="screen" />
        

    </head>

    <body>

        <div class="adminx-container bg">
            <nav class="navbar navbar-expand justify-content-between fixed-top">
                <div class="navbar-brand m-0 pl-0 h1 d-none d-md-block">
                    <a href="<?php echo $baseUrl ?>dashboard" style="text-decoration: none;">
                        <img src="./dist/img/logo-proradis-color.png" class="img-fluid p-2" style="max-height: 55px;">
                    </a>
                    
                </div>

                <div class="d-flex flex-1 d-block d-md-none">
                    <a href="#" class="sidebar-toggle ml-3">
                        <i data-feather="menu"></i>
                    </a>
                </div>

                <ul class="navbar-nav d-flex justify-content-end mr-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
                            <i class="far fa-user-circle" style="font-size: 25px; padding: 0 30px; color: #212529"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item text-danger" href="<?php echo $baseUrl ?>system/logout">Sair</a>
                        </div>
                    </li>
                </ul>
            </nav>

        <?php include 'menu.php'; ?>