<?php
session_start();
use App\Autoloader;
use App\Models\CategoriesModel;
use App\Models\PlatsModel;




require_once "../../Autoloader.php";
Autoloader::register();
require_once "../../controllers/head_script.php";
require_once "../../controllers/nav_script.php";
$plat= new PlatsModel();
$categorie= new CategoriesModel();
$categories= $categorie->findby();
var_dump($categories);


?>
<form action="" method="post"></form>
<label for="libelle">Libellé :</label>
    <input type="text" name="libelle" value="<?= $obj->libelle ?>"><br>
    <label for="description">Description :</label>
    <textarea name="description"><?= $obj->description ?></textarea><br>
    <label for="prix">Prix :</label>
    <input type="number" name="prix" value="<?= $obj->prix ?>"><br>
    <label for="image">Image :</label>
    <input type="text" name="image" value="<?= $obj->image ?>"><br>
    <label for="id_categorie">Catégorie :</label>
    <select name="id_categorie">
       <?php foreach ($categories as $categorie) : ?>
            <option value="<?= $categorie->id ?>" <?= ($categorie->id == $obj->id_categorie) ? 'selected' : '' ?>>
                <?= $categorie->libelle ?>
            </option>
        <?php  endforeach ?> -->
        <?php
        var_dump($categories);
        ?>






















libelle
description
prix
image
id_categorie
active