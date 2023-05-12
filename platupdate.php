<?php

use App\Autoloader;
use App\Models\PlatsModel;

require_once "./Autoloader.php";
Autoloader::register();

require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";


$platdetail = new PlatsModel();
$id = $_GET['id'];
$plat = $platdetail->find($id);

$obj = (object) $plat;

?>
<form method="post" action="/controllers/update_plat_script.php">
    <input type="hidden" name="id" value="<?= $obj->id ?>"> <!-- call getId() on object -->
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
        <?php endforeach ?>
    </select><br>
    <label for="active">Actif :</label>
    <input type="checkbox" name="active" <?= ($obj->active) ? 'checked' : '' ?>><br>
    <input type="submit" value="Enregistrer">
</form>
