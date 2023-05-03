<?php

use App\Autoloader;
use App\Models\CategoriesModel;
use App\Models\CommandesModel;

require_once "./Autoloader.php";
Autoloader::register();

$categoriemodel = new CategoriesModel();

$categories = $categoriemodel->findBy(['active' => 1,]);
// var_dump($categories);

$mostplat = new CommandesModel();

$most_plat = $mostplat->most_pop_plat();

// var_dump($most_plat);

require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";
?>

<h1 style="text-align:center;color:red;"> ici une image + search input</h1>



<div class="container">
    <div class="row cate">
        <?php foreach ($categories as $cat) :
            $obj = (object) $cat; ?>
            <div class="col-lg-4 card  ">
                <a href="/?page=detail&c_id=<?= $obj->id ?>">
                    <h5 class="card-header"><?= $obj->libelle ?></h5>
                    <div class="imgcat">
                        <img src="assets/images/category/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<h1 style="text-align:center;color:red;"> modifier pour n'avoir que 6 cat !!!</h1>
<div class="container">
    <div class="row mplat">
        <?php foreach ($most_plat as $mplat) :
            $obj = (object) $mplat; ?>
            <div class="col-lg-4 card  ">
                <a href="/?page=detail&c_id=<?= $obj->id ?>">
                    <h5 class="card-header"><?= $obj->libelle ?></h5>
                    <div class="imgcat">
                        <img src="assets/images/food/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
require_once "./controllers/footer_script.php";
?>