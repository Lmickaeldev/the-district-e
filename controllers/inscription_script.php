<?php
use App\Core\Db;
//ont verifie si le formulaire a été envoyer 
if (!empty($_POST)) {
    //le formulaire a été envoyé
    //on verifie que all champs ont bien été remplis,
    if (isset($_POST["nickname"],$_POST["email"],$_POST["pass"],$_POST["nom"],$_POST["prenom"],$_POST["adresse"],$_POST["num"])
    && !empty($_POST['nickname'])
    && !empty($_POST['email'])
    && !empty($_POST['pass'])
    && !empty($_POST['prenom'])
    && !empty($_POST['nom'])
    && !empty($_POST['adresse'])
    && !empty($_POST['num'])
    ) {
        //le formulaire est complet
        //on protege les données
        //on recuipere les données en les protegeant(xss)
        //striptags enleve toute les balise html
        $pseudo = strip_tags($_POST["nickname"]);
        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        $adresse = strip_tags($_POST["adresse"]);
        $num = strip_tags($_POST["num"]);




        //ont verfie que l'adresse est bien une adresse eamil 
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("l'email est incorrecte");
        }
        //on va hasher le mots de passe
        //password_argon2id permets un criptage aleatoire
        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
        
        //ont enregistre en bdd
        require"Core/Db.php";

        //on récupère l'instance de la connexion à la BDD
        $db = Db::getInstance();

        $sql= "INSERT INTO `utilisateurs`(`username`,`nom`,`prenom`,`adesse`,`num`,`mail`,`inscription`,`pass`,`role_id`) 
        VALUES(:pseudo,:nom,:prenom,:adresse,:num,:email,NOW(),'$pass','4')";
        //preparation de la requete
        $query = $db-> prepare($sql);

        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $query->bindValue(":nom",$nom,PDO::PARAM_STR);
        $query->bindValue(":prenom",$prenom,PDO::PARAM_STR);
        $query->bindValue(":adresse",$adresse,PDO::PARAM_STR);
        $query->bindValue(":num",$num,PDO::PARAM_STR);
        $query->bindValue(":email",$_POST["email"],PDO::PARAM_STR);
        $query->execute();

        
        //on connect l'utilisateur
    }else {
        die("le formualaire n'est pas complet");
    }
}
?>