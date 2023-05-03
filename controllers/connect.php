<?php
//changement en fonction de la base de donnée
define("DBHOST","localhost");
define("DBUSER","Lmickael");
define("DBPASS","afpa404");
define("DBNAME","district");
//ne pas changer le reste
//ont definie le data source name de connection 
$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

try {
    //ont ce connecte a la base de données en "instanciant" PDO
    $db = new PDO($dsn, DBUSER, DBPASS);
    // on definit le charset a "utf8"
    $db->exec("SET NAMES utf8");
    //ont definie la methode de récuperation (fetch) des données
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    //PDOException $e -> on attrape  l'erreur provoqué par le new PDDO cas d'echec
    //on affiche le message d'erreur si le new PDO échoue
    die($e->getMessage());
}
//ici ont est connecté


?>