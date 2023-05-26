<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Autoloader;
//require
require_once "../Autoloader.php";
Autoloader::register();
require_once "../controllers/head_script.php";
require_once "../controllers/nav_script.php";
require_once '../vendor/autoload.php';
//variable du formulaire
$mail = new PHPMailer(true);
$username = $_POST['userName'];
$useremail = $_POST['userEmail'];
$subject = $_POST['subject'];
$usermessage = $_POST['content'];
//var dump de test 
// var_dump($username);
// var_dump($useremail);
// var_dump($subject);
// var_dump($usermessage);

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; //smtp de gmail
    $mail->SMTPAuth = true; // passage en 1 pour l'authentification
    $mail->Port = 465;
    $mail->Username="mickaeldevtest@gmail.com";
    $mail->Password="5rjn8x9YL3As3YL4";
    $mail->SMTPSecure = "ssl";


    // Expéditeur du mail
    $mail->setFrom($useremail);
    
    // Destinataires
    $mail->addAddress('mickaeldevtest@gmail.com', 'The District Company');

    // Adresse de réponse
    $mail->addReplyTo($useremail, "Reply");


    // Format HTML
    $mail->isHTML(true);


    // Sujet du mail
    $mail->Subject = "demande de contact ";

    // Corps du message
    $mail->Body = '
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de mail</title>
</head>
<body>
    <div style="text-align: center;">
    <img src="https://i.imgur.com/trAgCUj.png" alt="Logo" width="100%" height="400px">
        <h1>prise de contact.</h1>
    </div>
    <h3 style="font-weight: bold;">
    nom: 
    </h3>
    <p>'.$username.'</p>
    <h3 style="font-weight: bold;">
        Adresse email: 
    </h3>
    <p>'.$useremail.'</p>
    <h3 style="font-weight: bold;">
        sujet du message: 
    </h3>
    <p>'.$subject.'</p>
    <h3 style="font-weight: bold;">
        contenu du Message: 
    </h3>
    <p>'.$usermessage.'</p>
</body>
</html>';

    // Envoi du mail
    $mail->send();
    echo 'Email envoyé avec succès';
} catch (Exception $e) {
    echo "L'envoi de mail a échoué. L'erreur suivante s'est produite : ", $mail->ErrorInfo;
}

$_SESSION['flash']['success'] = 'votre demande de contact a bien été prise en compte ';
header('Location: ../index.php');







?>