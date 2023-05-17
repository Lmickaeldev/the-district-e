<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host = 'localhost';
    $mail->SMTPAuth = false;
    $mail->Port = 1025;

    // Expéditeur du mail
    $mail->setFrom('from@thedistrict.com', 'The District Company');

    // Destinataires
    $mail->addAddress("client1@example.com", "Mr Client1");
    $mail->addAddress("client2@example.com");

    // Adresse de réponse
    $mail->addReplyTo("reply@thedistrict.com", "Reply");

    // CC & BCC
    $mail->addCC("cc@example.com");
    $mail->addBCC("bcc@example.com");

    // Format HTML
    $mail->isHTML(true);


    // Sujet du mail
    $mail->Subject = 'Test PHPMailer';

    // Corps du message
    $mail->Body = "On teste l'envoi de mails avec PHPMailer";

    // Envoi du mail
    $mail->send();
    echo 'Email envoyé avec succès';
} catch (Exception $e) {
    echo "L'envoi de mail a échoué. L'erreur suivante s'est produite : ", $mail->ErrorInfo;
}
