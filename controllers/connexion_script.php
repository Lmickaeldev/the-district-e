<?php
//on verifie si le formulaire a été envoyer 
if (!empty($_POST)) {
    //le formulaire a été envoyé
    //on verifie que all champs ont bien été remplis,
    if (isset($_POST['email'], $_POST['pass']) 
    && !empty($_POST["email"])
    && !empty($_POST["pass"])
) {
        //on verifie que l'email est valide
        if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            die("ce n'est pas un email");
        }

        //on ce connecte a la bdd
        require_once"Core/Db.php";

        $sql = "SELECT * FROM `user` WHERE `email`= :email";

        $query = $db->prepare($sql);
        $query->bindValue(":email",$_POST["email"], PDO::PARAM_STR);
        //ont execute

        $query->execute();

        $user = $query->fetch();


        var_dump($user);
    }
}
?>