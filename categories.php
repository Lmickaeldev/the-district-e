<?php
session_start();
use App\Autoloader;
use App\Models\CategoriesModel;


require_once "./Autoloader.php";
Autoloader::register();
$categoriemodel = new CategoriesModel();

$categories = $categoriemodel->findBy(['active' => 1,]);

// var_dump($categories);


require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";
?>
<div class="container">
    <div class="row cate">
        <?php foreach ($categories as $cat) :
            $obj = (object) $cat; ?>
            <div class="col-lg-4 card  ">
                <h5 class="card-header"><?= $obj->libelle ?></h5>
                <div class="imgcat">
                    <img src="assets/images/category/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                </div>
                <a class="btn" href="categoriedetails.php?id=<?= $obj->id ?>">consulter</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<h1 style="text-align:center;color:red;"> modifier pour n'avoir que 6 cat !!</h1>









<?php
require_once"./controllers/footer_script.php";
?>