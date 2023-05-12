<?php
session_start();
//var_dump($_SESSION); 
use App\Autoloader;
use App\Models\UtilisateursModel;
require_once "./Autoloader.php";
Autoloader::register();

if(isset($_SESSION['auth'])) 
{
  // L'utilisateur est connecté, permettre l'accès à la page du profil
  ?>
  <?php
    require_once "./controllers/head_script.php";
    require_once "./controllers/nav_script.php";
    $utimodel = new UtilisateursModel;
    $uti = $utimodel->find($_SESSION['auth']['id']);    
    var_dump($uti);
?>
<h1>connexion au profil effectué </h1>
  <?php
} else {
  // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page d'accueil ou afficher un message d'erreur
  //header("Location: index.php"); // Redirige vers la page d'accueil
  ?><h1>connexion au profil refusé</h1>
  <?php
  exit(); // Quitte le script pour éviter toute exécution supplémentaire
}
?>




voir ajax pour update checkbox !!!