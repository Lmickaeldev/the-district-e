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
<div class="row">
    <div id="search">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="je cherche..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">rechercher</button>
        </form>
    </div>
</div>
<div class="container">
    <h1 class="desctype">categorie</h1>
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
    <div class="row cate">
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