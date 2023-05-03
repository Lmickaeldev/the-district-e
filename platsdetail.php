<?php

use App\Autoloader;
use App\Models\PlatsModel;

require_once "./Autoloader.php";
Autoloader::register();

require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";


$id = $_GET['id'];

$platdetail = new PlatsModel();

$plat = $platdetail->find($id);

// var_dump($plat);
$obj = (object) $plat;
?>

<div class="row">
    <div class="col-md-6">
        <h2><?= $obj->libelle ?></h2>
        <div class="imgplat">
            <img src="assets/images/food/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
        </div>

    </div>
    <div class="col-md-6">
        <p><?= $obj->description ?></p>
        <p><?= $obj->prix ?> €</p>
    </div>
</div>













<?php
require_once "./controllers/footer_script.php";
?>