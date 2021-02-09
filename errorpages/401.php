<?php

include "../db.php";

?>

<!doctype html>
<html lang="en">

<head>
    <?php
    include "../head.php";
    ?>
    <!-- <title>PDF</title> -->
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body>
<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <p class="h5 my-0 me-md-auto fw-normal">PDF maker</p>
    <nav class="my-2 my-md-0 me-md-3">
        <a class="btn btn-outline-primary" href="register.php">Registreer</a>
        <a class="btn btn-outline-primary" href="signin.php">Log in</a>
    </nav>
</header>

<main class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Fout</h1>
    </div>

    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col mx-auto">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">401: Unauthorized</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title"><i class="bi bi-file-text"></i></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Er is een fout opgetreden</li>
                        <li>Druk op de knop om terug te gaan naar de index</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-primary"
                            onclick="window.location.href='../index.php'">Index
                    </button>
                </div>
            </div>
        </div>
    </div>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <small class="d-block mb-3 text-muted">&copy; 2021</small>
            </div>
        </div>
    </footer>
</main>
</body>

</html>