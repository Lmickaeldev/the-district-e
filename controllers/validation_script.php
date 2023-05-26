<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Autoloader;
use App\Models\CommandesModel;
use App\Models\PlatsModel;
use App\Models\PanierModel;

require_once "../Autoloader.php";
Autoloader::register();
require_once "../controllers/head_script.php";
require_once "../controllers/nav_script.php";
require_once '../vendor/autoload.php';
$panier = new PlatsModel();
$paniermodel = new PanierModel();
$commande = new CommandesModel();

$cmd= $commande->findall();
//var_dump($cmd);
$mail = new PHPMailer(true);
$ids = array_keys($_SESSION['panier']);
$ids = array_keys($_SESSION['panier']);
if (empty($ids)) {
    $product = array();
} else {
    $product = $panier->panier($ids);
}
$total=0;
foreach ($product as $products) :
    $obj = (object) $products;
    $quantity = $_SESSION["panier"][$obj->id];
    // Calcul du sous-total pour chaque produit
    $subtotal = $obj->prix * $quantity;
    // Ajout du sous-total au total
    $total += $subtotal;
endforeach;

//var_dump($product);
//var_dump($_SESSION['auth']['mail']);
$quantity = $_SESSION["panier"][$obj->id];
$idc=$_SESSION["auth"]['id'];
$description = $obj->description;
$libelle= $obj->libelle;
$id= $obj->id;
$prix = number_format($obj->prix, 2);
$date = date('d-m-Y H:i:s'); // Get the current date and time
$formattedDate = date('Y-m-d H:i:s', strtotime($date));
//var_dump($_SESSION['panier']);
//var_dump($quantity);
//var_dump($total);
//var_dump($prix);
//var_dump($idc);


if (!isset($_SESSION['auth']) && isset($_SESSION['panier'])) {
    die(" vous devez connecter pour passer la commande ");
    
}else{
    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = true;
        $mail->Port = 465;
        $auth_username="mickaeldevtest@gmail.com";
        $auth_password="5rjn8x9YL3As3YL4";






        // Expéditeur du mail
        $mail->setFrom('mickaeldevtest@gmail.com', 'The District Company');
    
        // Destinataires
        $mail->addAddress($_SESSION['auth']['mail'],$_SESSION['auth']['username']);
    
        // Adresse de réponse
        $mail->addReplyTo("mickaeldevtest@gmail.com", "Reply");
    
    
        // Format HTML
        $mail->isHTML(true);
    
    
        // Sujet du mail
        $mail->Subject = "confirmation de commande ";
    
        // Corps du message
        $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Confirmation de commande</title>
    </head>
    <body>
        <div style="text-align: center;">
        <img src="https://i.imgur.com/trAgCUj.png" alt="Logo" width="100%" height="400px">
            <h1>Confirmation de commande</h1>
        </div>
        <p>
            Bonjour,<br>
            Nous vous remercions d\'avoir passé commande auprès du Restaurant District.
        </p>
        <section>
            <h2>Détails de la commande :</h2>
            <ul style="list-style-type: none;">
                <li>'.$libelle.'</li>
                <li>au prix de '.$prix.' €</li>
                <li>pour une quantité: '.$quantity.'</li>
                <li>Description:'.$description.'</li>
            </ul>
        </section>
        <h2>pour un montant total de la commande :'.$total.' euro</h2>
    
        a bien été prise en compte le '.$date.'
    </body>
    </html>';
    
        // Envoi du mail
        $mail->send();
        echo 'Email envoyé avec succès';
    } catch (Exception $e) {
        echo "L'envoi de mail a échoué. L'erreur suivante s'est produite : ", $mail->ErrorInfo;
    }
    $add= $commande
    ->setId_plat($id)
    ->setQuantite($quantity)
    ->setTotal($total)
    ->setDate_commande($formattedDate)
    ->setEtat('2')
    ->setId_client($idc);
    $commande->create($add);
    $_SESSION['flash']['success'] = 'votre commande viens d\'etre enregistré ';
    unset($_SESSION["panier"]);
    header('Location: ../index.php');
}
?>
