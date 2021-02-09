<?php
include "./db.php";
?>

<!doctype html>
<html lang="en">

<head>
    <?php
    include "./head.php";
    ?>
    <link href="./css/style.css" rel="stylesheet">
</head>

<body id="body">
<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <p class="h5 my-0 me-md-auto fw-normal">PDF maker</p>
    <nav class="my-2 my-md-0 me-md-3">
        <a class="btn btn-outline-primary" href="register.php">Registreer</a>
        <a class="btn btn-outline-primary" href="signin.php">Log in</a>
    </nav>
</header>
<div class="container">
    <main>
        <div class="py-5 text-center">
            <h2>Registratieformulier</h2>
        </div>
        <h4 class="mb-3">Uw gegevens</h4>

        <form class="" method="post">
            <table class="table">
                <thead>
                <tr>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Voorletter(s) en Achternaam</td>
                    <td><input type="text" class="form-control" name="name" id="name"
                               placeholder="Vul hier uw Naam in" required></td>
                </tr>
                <tr>
                    <td>Straatnaam en Huisnummer</td>
                    <td><input type="text" class="form-control" name="adres" id="adres"
                               placeholder="vul hier uw Straatnaam en Huisnummer in" required></td>
                </tr>
                <tr>
                    <td>Postcode en Woonplaats</td>
                    <td><input type="text" class="form-control" name="postalcode" id="postalcode"
                               placeholder="Vul hier uw Postcode en Woonplaats in" required></td>
                </tr>
                <tr>
                    <td>Geboortedatum</td>
                    <td><input type="date" class="form-control" name="dob" id="dob"
                               placeholder="Vul hier uw Geboortedatum in" required></td>
                </tr>
                <tr>
                    <td>Plaats</td>
                    <td><input type="text" class="form-control" name="plaats" id="plaats"
                               placeholder="Vul hier een Plaats in" required></td>
                </tr>
                <tr>
                    <td>E-mailadres</td>
                    <td><input type="text" class="form-control" name="email" id="email"
                               placeholder="Vul hier uw E-mailadres in" required></td>
                </tr>
                <tr>
                    <td>Wachtwoord</td>
                    <td><input type="password" class="form-control" name="password" id="password"
                               placeholder="Vul hier uw wachtwoord in" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Registreer</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </main>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <small class="d-block mb-3 text-muted">&copy; 2021</small>
            </div>
        </div>
    </footer>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST["name"];
    $adres = $_POST["adres"];
    $postalcode = $_POST["postalcode"];
    $dob = $_POST["dob"];
    $plaats = $_POST["plaats"];
    $email = $_POST["email"];
    $options = ['cost' => 12, $_ENV['SALT']];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT, $options);
    $stmt = $pdo->prepare("INSERT INTO users (name, adres, postalcode, dob, plaats, email, password) VALUES ('$name', '$adres', '$postalcode', '$dob', '$plaats', '$email', '$password')");
    $stmt->execute();
    echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">Uw account is succesvol aangemaakt, u kunt nu inloggen! <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button></div>";

}
?>
</body>

</html>