<?php
// On récupère les données du formulaire
$id = $_POST['id'];
$libelle = $_POST['libelle'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$image = $_POST['image'];
// $idCategorie = $_POST['id_categorie'];
$active = isset($_POST['active']) ? true : false;

// On récupère l'objet Plat correspondant à l'ID
$plat = $platManager->getById($id);

// On met à jour les propriétés de l'objet avec les nouvelles valeurs
$plat->hydrate([
    'libelle' => $libelle,
    'description' => $description,
    'prix' => $prix,
    'image' => $image,
    'id_categorie' => $idCategorie,
    'active' => $active
]);

// On sauvegarde les modifications en base de données
$platManager->update($plat);

// On redirige vers la page de détail du plat
header('Location: detail_plat.php?id='.$plat->getId());
exit;
