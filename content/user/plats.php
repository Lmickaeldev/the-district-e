<?php
session_start();
use App\Autoloader;

use App\Models\PlatsModel;


require_once "../../Autoloader.php";
Autoloader::register();

$platmodel = new PlatsModel();


$plat = $platmodel->findAll();
// var_dump($plat);

require_once "../../controllers/head_script.php";
require_once "../../controllers/nav_script.php";
?>
<?php if(isset($_SESSION['flash']['success'])) {
    $message = $_SESSION['flash']['success'];
    unset($_SESSION['flash']['success']);
?>
<div class="alert alert-success" role="alert">
        <?php echo $message; }?>
</div>

<div class="container">
      
    <div class="row cate">
        <?php foreach ($plat as $platall) :
            $obj = (object) $platall; ?>
            <div class="col-lg-4 card  ">
                
                    <h5 class="card-header"><?= $obj->libelle ?></h5>
                    <div class="imgplat">
                        <img src="../../assets/images/food/<?= $obj->image ?>" class="card-img-bottom" alt="<?= $obj->image ?>">
                    </div>
                    <!-- <p><?= $obj->description ?></p> -->
                    <p class="price"><?= number_format($obj->prix,2,',')  ?> €</p>
                    <a class="btn btn-primary" href="platsdetail.php?id=<?= $obj->id ?>">details</a>
                    <a class="btn btn-primary" href="/controllers/commande_script.php?id=<?= $obj->id ?>">commander</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
require_once"../../controllers/footer_script.php";
?>