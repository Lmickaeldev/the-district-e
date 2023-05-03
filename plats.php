<?php
use App\Autoloader;
use App\Models\PlatsModel;

require_once "./Autoloader.php";
Autoloader::register();

$platmodel = new PlatsModel();

$plat = $platmodel->findAll();
// var_dump($plat);

require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";
?>
<h1 style="text-align:center; color:red;"> ici une image + search input</h1>
<div class="container">
    <div class="row plat">
        <?php foreach ($plat as $platall) :
            $obj = (object) $platall; ?>
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
<h1 style="text-align:center;color:red;"> Probleme de prix pas de float !! voir avec le formateur </h1>









<?php
require_once"./controllers/footer_script.php";
?>