<?php 
session_start();
var_dump($_SESSION);
?>

exemple, si vous avez stocké l'ID de l'utilisateur dans une session, vous pouvez utiliser cette valeur pour mettre à jour un champ dans la base de données :


// Démarrer la session
session_start();

// Se connecter à la base de données
$conn = mysqli_connect("localhost", "nom_utilisateur", "mot_de_passe", "nom_base_de_données");

// Vérifier si l'utilisateur est authentifié
if (isset($_SESSION['utilisateur_id'])) {
  // Nettoyer l'ID de l'utilisateur avant de l'utiliser dans la requête
  $id = mysqli_real_escape_string($conn, $_SESSION['utilisateur_id']);

  // Effectuer la mise à jour dans la base de données
  $sql = "UPDATE utilisateurs SET champ = 'nouvelle_valeur' WHERE id = '$id'";
  mysqli_query($conn, $sql);
}
Dans cet exemple, la fonction mysqli_real_escape_string est utilisée pour nettoyer l'ID de l'utilisateur
 et éviter les attaques par injection SQL. Il est important d'utiliser des fonctions de nettoyage similaires pour toutes les données utilisateur avant de les utiliser dans une requête SQL.