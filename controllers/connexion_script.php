<?php
session_start();
use App\Autoloader;
use App\Models\UtilisateursModel;

require_once "../Autoloader.php";
Autoloader::register();
$test= new UtilisateursModel;

// la fonction isset() vérifiera que ces données existent.
if ( !isset($_POST['inputEmail'], $_POST['inputPassword']) ) {
    
    exit('Vous devez entrer votre email et votre mot de passe!');
}else{
    $email = $_POST['inputEmail'];
	$password = $_POST['inputPassword'];
}


$stmt =$test->user_co($email);
 var_dump($stmt);
    var_dump($password);
  

    if($stmt){
        if(
            
            password_verify($password, $stmt["pass"])
            )
        {
            $_SESSION['auth'] = $stmt;
            $_SESSION['flash']['success'] = "Bonjour " .$stmt["username"]. ". Vous êtes maintenant connecté";
            
            header('Location: ../index.php');
            //echo "connection reussi";
            exit();
        }else{
            $_SESSION['flash']['danger'] = 'Le mails ou mots de passe envoyées est invalides';

            header('Location: ../connexion.php');
            
         }
    }else{
            $_SESSION['flash']['danger'] = 'Authentification impossible!';

            header('Location: ../connexion.php');
            
         }

?>