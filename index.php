<?php
include "./db.php";
unset($message);

if (isset($_POST["login"])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        $message = "Vul alle velden in";
    } else {
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $pdo->prepare($query);
        $statement->execute(
            array(
                ':email' => $_POST["email"],
            )
        );


        $count = $statement->rowCount();
        if ($count > 0) {
            $user = $statement->fetch();
            if (!password_verify($_POST['password'], $user['password'])) {
                // wachtwoord klopt niet
                $message = "Foute Login informatie";
            } else {
                $_SESSION["email"] = $_POST["email"];
                header("location: ./users/index.php");
                exit();
            }
        } else {
            // email niet gevonden
            $message = "Foute Login informatie";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php
    include "./head.php";
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
        <table>
            <form method="post" id="login">
                <th>
                    <label for="email" class="visually-hidden">E-mailadres</label>
                    <input type="email" id="email" class="form-control" placeholder="Email address" required autofocus
                           name="email">
                </th>
                <th><label for="password" class="visually-hidden">Wachtwoord</label>
                    <input type="password" id="password" class="form-control" placeholder="password" required
                           name="password">
                </th>
                <th>
                    <button class="btn btn-outline-primary" value="login" type="submit" name="login">Log
                        In
                    </button>
                </th>
            </form>
            <th>
                <a class="btn btn-outline-primary" href="register.php">Registreer</a>
            </th>
        </table>
    </nav>
</header>

<main class="container">
    <div class="pricing-header px- py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">PDF Maker</h1>
    </div>

    <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
        <div class="col mx-auto">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Ingelogd</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title"><i class="bi bi-file-lock"></i></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>U bent niet ingelogd</li>
                        <li>Om gebruik te kunnen maken van de service moet u ingelogd zijn</li>
                        <li>Gebruik het menu om in te loggen</li>
                    </ul>
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