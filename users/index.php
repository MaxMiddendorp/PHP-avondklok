<?php
include "../db.php";

if (!isset($_SESSION["email"])) {
     header("location: ../signin.php");
     exit();
 }


$email = $_SESSION["email"];

try {
    $sql = "SELECT name FROM users WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":email" => $email));
    $user = $stmt->fetch();
    $_SESSION["user"] = $user;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php
    include "../head.php";
    ?>
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
        <a class="btn btn-outline-primary">Welkom <?php echo $_SESSION['user']['name']; ?></a>
        <a class="btn btn-outline-primary" onclick="window.location.href='../signout.php'">Log uit</a>
    </nav>
</header>

<main class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">PDF Maker</h1>
        <!-- <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap
            example. It’s built with default Bootstrap components and utilities with little customization.</p> -->
    </div>

    <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
        <div class="col mx-auto">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Download</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title"><i class="bi bi-file-text"><i
                                    class="bi bi-download"></i></i></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Druk op de knop om een PDF te maken</li>
                        <li>De PDF wordt meteen gedownload</li>
                        <br>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-primary"
                            onclick="window.location.href='download.php'">Maak en download PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="col mx-auto">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Mail</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title"><i class="bi bi-envelope"></i><i
                                class="bi bi-forward"></i></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Druk op de knop om een PDF te maken</li>
                        <li>De PDF wordt meteen naar u ge-e-maild</li>
                        <li>Deze functie is momenteel in ontwikkeling</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-primary"
                            onclick="window.location.href='mail.php'">Maak en mail PDF
                    </button>
                </div>
            </div>
        </div>
        <!-- <div class="col">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Enterprise</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>30 users included</li>
                        <li>15 GB of storage</li>
                        <li>Phone and email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button>
                </div>
            </div>
        </div> -->
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