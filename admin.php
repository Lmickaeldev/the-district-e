<?php

use App\Autoloader;
use App\Models\CategoriesModel;
use App\Models\CommandesModel;
use App\Models\PlatsModel;
use App\Models\UtilisateursModel;

require_once "./Autoloader.php";
Autoloader::register();

require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";
$platmodel = new PlatsModel;
$catmodel = new CategoriesModel;
$utimodel = new UtilisateursModel;
$commodel = new CommandesModel;


$plat = $platmodel->findAll();
$cat = $catmodel->findAll();
$uti = $utimodel->findAll();
$com = $commodel->findAll();

//var_dump($plat);
?>
<nav>
    
    <div id="navbarNav">
     <ul class="nav" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab1" role="tab">categories</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab2" role="tab">plats</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab3" role="tab">commandes</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab4" role="tab">utilisateurs</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab5" role="tab">livraison</a>
        </li>
    </ul>
    </div>



   
</nav>
<div class="tab-content">

    <div class="tab-pane active" id="tab1" role="tabpanel">
        <h1>categories</h1>
        <div class="row cate">
        <table style="align-items: center;">
        <thead>
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Image</th>
    </tr>
  </thead>
  <tbody>
        <?php foreach ($cat as $cate) :
            $obj = (object) $cate; ?>
                <tr>
                <td><?= $obj->id ?></td>
                <td><?= $obj->libelle ?></td>
                <td><?= $obj->image ?></td>
                </tr>
                
        
        <?php endforeach; ?>
  </tbody>
        </table>
        </div>
    </div>

    <div class="tab-pane" id="tab2" role="tabpanel">
        <h1>plats</h1>

    </div>

    <div class="tab-pane" id="tab3" role="tabpanel">
        <h1>commande</h1>

    </div>

    <div class="tab-pane" id="tab4" role="tabpanel">

        <h1>utilisateurs</h1>

    </div>

    <div class="tab-pane" id="tab5" role="tabpanel">
        <h1>livraison</h1>

    </div>

</div>






<?php
require_once "./controllers/footer_script.php";
?>