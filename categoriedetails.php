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
    <div class="row cate">
        <?php foreach ($categoriedet as $platdet) :
            $obj = (object) $platdet; ?>
            <div class="col-lg-4 card">
                
                    <h5 class="card-header"><?= $obj->libelle ?></h5>
                    <div class="imgplat">
                        <img src="assets/images/food/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                    </div>
                    <!-- <p><?= $obj->description ?></p> -->
                    <p class="price"><?= number_format($obj->prix,2,',')  ?> €</p>
                    <a class="btn btn-primary" href="platsdetail.php?id=<?= $obj->id ?>">details</a>
                    <a class="btn btn-primary" href="/controllers/commande_script.php?id=<?= $obj->id ?>">commander</a>

                
            </div>
        <?php endforeach; ?>
    </div>
</div>