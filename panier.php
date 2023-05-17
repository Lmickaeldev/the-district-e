<?php
session_start();

use App\Autoloader;
use App\Models\PlatsModel;
use App\Models\PanierModel;

require_once "./Autoloader.php";
Autoloader::register();
require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";
$panier = new PlatsModel();
$paniermodel = new PanierModel();

$ids = array_keys($_SESSION['panier']);
if (empty($ids)) {
    $product = array();
} else {
    $product = $panier->panier($ids);
}
if (isset($_GET['del'])) {
    $paniermodel->del($_GET['del']);
}
$total = 0;
$ids = array_keys($_SESSION['panier']);
if (empty($ids)) {
    $product = array();
} else {
    $product = $panier->panier($ids);
}

//var_dump($product);
// var_dump($_SESSION['panier']);
// var_dump($ids);

if (!empty($_SESSION['panier'])) {?>
    <div class="container">
    <div class="row">
        <table class="tab table table-bordered-sm  ">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Image</th>
                    <th>quantité</th>
                    <th>Prix</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0; // Initialise le total à 0
                foreach ($product as $products) :
                    $obj = (object) $products;
                    $quantity = $_SESSION["panier"][$obj->id];
                    // Calcul du sous-total pour chaque produit
                    $subtotal = $obj->prix * $quantity;
                    // Ajout du sous-total au total
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= $obj->libelle ?></td>
                        <td><img src="assets/images/food/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>"></td>
                        <td><?= $quantity ?></td>
                        <td><?= number_format($obj->prix, 2, ',') ?> €</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="platsdetail.php?id=<?= $obj->id ?>">details</a>
                            <a class="btn btn-primary btn-sm" onClick="return confirm('supprimer le plat de la commande ?')" href="panier.php?del=<?= $obj->id ?>"><span class="bi-pencil"></span> supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>
    <div class="row">
    <!-- Afficher le total -->
    <h2>Total <span><?= number_format($total, 2, ',') ?> €</span></h2>
    <a href="/controllers/validation_script.php" class="btn btn-primary">commander</a>
    </div>
</div>

<?php    
}else{
    die('votre paniers est vide retournons vers l\'accueil ');
}
?>



<?php

require_once "./controllers/footer_script.php";
?>
