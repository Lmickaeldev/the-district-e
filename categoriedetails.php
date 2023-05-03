<?php
use App\Autoloader;
use App\Models\CategoriesModel;
use App\Models\PlatsModel;

require_once "./Autoloader.php";
Autoloader::register();

$id=$_GET['id'];
$categoriedet = new PlatsModel();

$categoriedet = $categoriedet->findBy(['id_categorie' => $id,]);

// var_dump($categoriedet);


require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";
?>
<div class="container">
    <div class="row plat">
        <?php foreach ($categoriedet as $platdet) :
            $obj = (object) $platdet; ?>
            <div class="col-lg-4 card  ">
                <a href="platsdetail.php?id=<?= $obj->id ?>">
                    <h5 class="card-header"><?= $obj->libelle ?></h5>
                    <div class="imgplat">
                        <img src="assets/images/food/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                    </div>
                    <p><?= $obj->description ?></p>
                    <p><?= $obj->prix ?> €</p>
                    <br>
                    <br>

                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>