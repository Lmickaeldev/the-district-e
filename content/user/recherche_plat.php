<?php
session_start();
use App\Autoloader;
use App\Models\PlatsModel;

require_once "../../Autoloader.php";
Autoloader::register();

if (!isset($_GET['search'])) {
    // Si aucun mot-clé de recherche n'a été saisi, afficher tous les plats
    $platsModel = new PlatsModel();
    $plats = $platsModel->findAll();
} else {
    // Si un mot-clé de recherche a été saisi, effectuer la recherche
    $search = $_GET['search'];
    //var_dump($search);
    $platsModels = new PlatsModel();
    $plats = $platsModels->search_plat($search);
}

// Afficher les plats
//var_dump($plats);
require_once "../../controllers/head_script.php";
require_once "../../controllers/nav_script.php";
?>
<div class="container">
    <div class="row search-form">
    <form method="GET" action="recherche_plat.php">
        <label for="search">Recherche :</label>
        <input type="text" id="search" name="search" placeholder="Entrez un mot-clé">
        <button type="submit">Rechercher</button>
    </form>
    </div>
    <div class="row cate">
<?php foreach ($plats as $platall) :
            $obj = (object) $platall; ?>
            <div class="col-lg-4 card  ">
                <h5 class="card-header"><?= $obj->libelle ?></h5>
                <div class="imgplat">
                    <img src="../../assets/images/food/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                </div>
                <p><?= $obj->description ?></p>
                <p><?= number_format($obj->prix,2,',')  ?> €</p>
                
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php
require_once"../../controllers/footer_script.php";
?>