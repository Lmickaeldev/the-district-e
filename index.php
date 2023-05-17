<?php
session_start();
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
<?php if(isset($_SESSION['flash']['success'])) {
    $message = $_SESSION['flash']['success'];
    unset($_SESSION['flash']['success']);

    ?>
    <div class="alert alert-success" role="alert">
        <?php echo $message; ?>
    </div>
    
<?php }
?>
<div class="row">
    <div id="searchid">
        <form class="d-flex" method="GET" action="recherche_plat.php">
            <input class="form-control me-2" type="search" placeholder="je cherche..." aria-label="Search" id="search" name="search">
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
                <h5 class="card-header"><?= $obj->libelle ?></h5>
                <div class="imgcat">
                    <img src="assets/images/category/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                </div>
                <a class="btn" href="categoriedetails.php?id=<?= $obj->id ?>">consulter</a>
                
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container">
<h1 class="desctype">Nos meileurs plats</h1>
    <div class="row cate">
        <?php foreach ($most_plat as $mplat) :
            $obj = (object) $mplat; ?>
            <div class="col-lg-4 card  ">
                <h5 class="card-header"><?= $obj->libelle ?></h5>
                <div class="imgcat">
                    <img src="assets/images/food/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                </div>
                <a class="btn" href="platsdetail.php?id=<?= $obj->id ?>">consulter</a>

            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
require_once "./controllers/footer_script.php";
?>