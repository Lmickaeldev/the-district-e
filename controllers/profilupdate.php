<?php
use App\Core\Db;
//ont verifie si le formulaire a été envoyer 
if (!empty($_POST)) {
    //le formulaire a été envoyé
    //on verifie que all champs ont bien été remplis,
    if (isset($_POST["username"],$_POST["email"],$_POST["pass"],$_POST["pass_retake"],$_POST["name"],$_POST["nickname"],$_POST["adresse"],$_POST["num"])
    && !empty($_POST['username'])
    && !empty($_POST['email'])
    && !empty($_POST['pass'])
    && !empty($_POST['pass_retake'])
    && !empty($_POST['nickname'])
    && !empty($_POST['name'])
    && !empty($_POST['adresse'])
    && !empty($_POST['num'])
    ) {
        //le formulaire est complet
        //on protege les données
        //on recuipere les données en les protegeant(xss)
        //striptags enleve toute les balise html
        $pseudo = strip_tags($_POST["username"]);
        $nom = strip_tags($_POST["name"]);
        $prenom = strip_tags($_POST["nickname"]);
        $adresse = strip_tags($_POST["adresse"]);
        $num = strip_tags($_POST["num"]);
        $id=$_GET['id'];


        //ont verfie que l'adresse est bien une adresse eamil 
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("l'email est incorrecte");
        }
        //on va hasher le mots de passe
        //password_argon2id permets un criptage aleatoire
        if ($_POST['pass_retake']==$_POST['pass']) {
            # code...
        }
        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
        
        //ont enregistre en bdd
        require"../Core/Db.php";

        //on récupère l'instance de la connexion à la BDD
        $db = Db::getInstance();

$sql = "UPDATE `utilisateurs`
        SET `username` = :pseudo, `nom` = :nom, `prenom` = :prenom, `adesse` = :adresse, `num` = :num, `mail` = :email, `pass` = :pass
        WHERE id = :id";

// Prepare the query
$query = $db->prepare($sql);

// Bind the parameter values
$query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
$query->bindValue(":nom", $nom, PDO::PARAM_STR);
$query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
$query->bindValue(":adresse", $adresse, PDO::PARAM_STR);
$query->bindValue(":num", $num, PDO::PARAM_STR);
$query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
$query->bindValue(":pass", $pass, PDO::PARAM_STR);
$query->bindValue(":id", $id, PDO::PARAM_INT);

// Execute the query
$query->execute();
//ont renvoie a la page profil
header('Location: ../content/user/profil.php');

        
        
    }else {
         die("le formualaire n'est pas complet");
        

    }
}
?>