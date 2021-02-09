<?php
//hier worden foutmeldingen uitgezet omdat de eindgebruiker deze niet hoeft te zien.
error_reporting(0);

// Connections

// if (isset($_SESSION["email"])) {
//     header("location: ../klant/index.php");
//     exit();
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use setasign\Fpdi\Fpdi;

require '../vendor/autoload.php';

include "../db.php";

$email = $_SESSION["email"];

try {
    $sql = "SELECT name, adres, postalcode, dob, plaats, email FROM users WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":email" => $email));
    $user = $stmt->fetch();
    $_SESSION["user"] = $user;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php
//Variables

$date = date("d-m-Y");
$naam = $_SESSION['user']['name'];
$email = $_SESSION["user"]["email"];
$filename = verklaring - $naam - $date . pdf;
?>

<?php
// PDF

$fullPathToFile = 'Eigen_verklaring_avondklok.pdf';

class PDF extends FPDI
{

    var $_tplIdx;

    function Header()
    {

        global $fullPathToFile;

        if (is_null($this->_tplIdx)) {

            $this->numPages = $this->setSourceFile($fullPathToFile);
            $this->_tplIdx = $this->importPage(1);

        }
        $this->useTemplate($this->_tplIdx);

    }

    function Footer()
    {
    }

}

$pdf = new PDF();

$pdf->AddPage();

$pdf->SetFont("Arial", "", 20);
$pdf->SetXY(60, 160);
$pdf->Write(5, $_SESSION["user"]['name']);
$pdf->SetXY(60, 174);
$pdf->Write(5, $_SESSION["user"]['adres']);
$pdf->SetXY(60, 184);
$pdf->Write(5, $_SESSION["user"]['postalcode']);
$pdf->SetXY(60, 198);
$pdf->Write(5, $_SESSION["user"]['dob']);
$pdf->SetXY(60, 211);
$pdf->Write(5, date("d-m-Y"));
$pdf->SetXY(60, 223);
$pdf->Write(5, date("d-m-Y"));

if ($pdf->numPages > 1) {
    for ($i = 2; $i <= $pdf->numPages; $i++) {
        $pdf->_tplIdx = $pdf->importPage($i);
        $pdf->AddPage();
        $pdf->SetXY(52, 65);
        $pdf->Write(5, "X");
        $pdf->SetXY(52, 192);
        $pdf->Write(5, "X");
        $pdf->SetXY(60, 223);
        $pdf->Write(5, $_SESSION["user"]['plaats']);
        $pdf->SetXY(60, 236);
        $pdf->Write(5, date("d-m-Y"));
    }
}

// $pdf->Output('output.pdf', 'F');
//$attachment = $pdf->Output('', 'S');
//"verklaring-$naam-$date.pdf"

$file = basename("verklaring-$naam-$date");    //create file
$file .= '.pdf';    //change extension of file to .pdf
$pdf->Output($file, 'F');   //save file

// mail
$mail = new PHPMailer(true);

try {
//Server settings
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = $_ENV['MAIL_HOST'];                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = $_ENV['MAIL_USER'];                     // SMTP username
    $mail->Password = $_ENV['MAIL_PASSWORD'];                               // SMTP password
    $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = $_ENV['MAIL_PORT'];                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//Recipients
    $mail->setFrom('maxmiddendorp@zohomail.eu', 'PDF');
    $mail->addAddress($email, $naam);     // Add a recipient

// Attachments
//    $mail->addAttachment($attachment, 'verklaring');         // Add attachments
//    $mail->addAttachment($attachment, 'verklaring-$naam-$date.pdf');    // Optional name
    $mail->AddAttachment("verklaring-$naam-$date.pdf");   //add attachment

// Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Hier is uw avondklok verklaring';
    $mail->Body = '<body>
                    <div align="center"><h1><strong>Avondklok verklaring</strong></h1></div>
                    <div align="center"><hr></div>
                    <div align="center"><br></div>
                    <div align="center"><strong>Beste ' . ' ' . $naam . ' ,</strong></div>
                    <div align="center"><strong>Hier is uw avondklok verklaring voor ' . ' ' . $date . '</strong></div>
                    <div align="center"><br></div>
                    <div align="center"><strong>Met vriendelijke Groet,</strong></div>
                    <div align="center"><strong><a href="http://avondklok-verklaring.rf.gd">avondklok-verklaring.rf.gd</a></strong></div>
                    </body>';
//    $mail->AltBody = 'Dit is de pdf die u heeft gegenereerd non-HTML';

    $mail->send();
    $verstuurd = 'Mail is verstuurd';
} catch (Exception $e) {
    $niet_verstuurd = "De mail kon niet worden verzonden zie de foutmelding voor meer informatie: {$mail->ErrorInfo}";
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include "../head.php";
    ?>
    <title>PDF</title>
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
    </div>

    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col mx-auto">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Done</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title"><i class="bi bi-file-text"></i></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>De PDF is gegenereerd</li>
                        <li>De PDF zal in enkele momenten in uw mail staan</li>
                    </ul>
                    <button type="button" class="w-100 btn btn-lg btn-primary"
                            onclick="window.location.href='index.php'">Terug naar index
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