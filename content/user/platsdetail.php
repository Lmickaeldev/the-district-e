<?php

use App\Autoloader;
use App\Models\PlatsModel;

require_once "../../Autoloader.php";
Autoloader::register();

require_once "../../controllers/head_script.php";
require_once "../../controllers/nav_script.php";


$id = $_GET['id'];


$platdetail = new PlatsModel();

$plat = $platdetail->find($id);
// var_dump($plat);
$obj = (object) $plat;
// $referer = $request->headers->get('referer');

?>

<div class="container platdet">
    <a class="btn btn-primary mt-4" href="javascript:history.back()">retours</a>
    <div class=" row ">
        <div class="col-md-6 detailplat">
            <h2><?= $obj->libelle ?></h2>
            <div class="">
                <img src="../../assets/images/food/<?= $obj->image ?>" class="img-thumbnail" alt="<?= $obj->image ?>">
            </div>

        </div>
        <div class="col-md-6 mt-5 detailplat">
            <p><?= $obj->description ?></p>
            <p class="pricedetail"><?= $obj->prix ?> €</p>
            <a class="btn btn-primary" href="/controllers/commande_script.php?id=<?= $obj->id ?>">commander</a>
        </div>
    </div>

</div>
<?php
require_once "../../controllers/footer_script.php";
?>