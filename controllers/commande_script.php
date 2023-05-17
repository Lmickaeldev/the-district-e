<?php
session_start();
use App\Autoloader;
use App\Models\PanierModel;
use App\Models\PlatsModel;

require_once "../Autoloader.php";
Autoloader::register();

require_once "../controllers/head_script.php";
require_once "../controllers/nav_script.php";

$panier = new PanierModel();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $commande = new PlatsModel();

    $cmd = $commande->find($id);
    
    if (!is_object($cmd)) {
        $panier->add($cmd);
        // die('le produit a bien été ajouté au panier <a href="plats.php">retour au plats</a>');
        $_SESSION['flash']['success'] = 'votre plats a bien été ajouter';
        header('Location: ../../content/user/plats.php');
    } else {
        die("Ce produit n'existe pas");
    }
} else {
    die("Vous n'avez pas sélectionné de produit à ajouter au panier"); 
}

?>
