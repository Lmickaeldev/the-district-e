<?php
// Démarre la session
session_start(); 
use App\Autoloader;
use App\Models\CategoriesModel;
use App\Models\CommandesModel;
use App\Models\PlatsModel;
use App\Models\UtilisateursModel;
require_once "./Autoloader.php";
Autoloader::register();

if (isset($_SESSION['auth']) && $_SESSION['auth']['role_id'] == 2) {
  // L'utilisateur est connecté en tant qu'administrateur, permettre l'accès à la page d'administration
  ?>
    <?php
require_once "./controllers/head_script.php";
require_once "./controllers/nav_script.php";
$platmodel = new PlatsModel;
$catmodel = new CategoriesModel;
$utimodel = new UtilisateursModel;
$commodel = new CommandesModel;




$plat = $platmodel->findAll();
$cat = $catmodel->findAll();
$uti = $utimodel->findAll();
$com = $commodel->comd();

//var_dump($uti);
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

        </ul>
    </div>




</nav>
<div class="tab-content">

    <div class="container-fluid tab-pane active" id="tab1" role="tabpanel">
        <h1>categories</h1>
        <a class="btn btn-primary btn-sm " href="#">ajouter categorie</a>

        
        <div class="row">
            <table class="tab">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Image</th>
                        <th>activé</th>
                        <th>menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cat as $cate) :
                        $obj = (object) $cate; ?>
                        <tr>
                            <td><?= $obj->id ?></td>
                            <td><?= $obj->libelle ?></td>
                            <td><?= $obj->image ?></td>
                            <td><input type="checkbox" name="active" <?php if ($obj->active) echo 'checked'; ?> disabled class="disabled-checkbox">
</td>
                            <td>
                            <a class="btn btn-primary btn-sm " href="update.php?id=<?= $obj->id ?>"><span class="bi-pencil"></span> modifier</a>
                                
                            </td>
                            <td>
                            <a class="btn btn-primary btn-sm " onClick="return confirm('supprimer utilisateurs ?')" href="/controllers/deletecat.php?id=<?= $obj->id ?>"><span class="bi-pencil"></span> supprimer</a>
                                
                            </td>
                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane" id="tab2" role="tabpanel">
        <h1>plats</h1>
        <a class="btn btn-primary btn-sm " href="update.php?id='.$item['id'].'">ajouter Plat</a>
        <div class="row cat">
            <table class="tab">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>description</th>
                        <th>Image</th>
                        <th>prix</th>
                        <th>menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($plat as $plate) :
                        $obj = (object) $plate; ?>
                        <tr>
                            <td><?= $obj->id ?></td>
                            <td><?= $obj->libelle ?></td>
                            <td><?= $obj->description ?></td>
                            <td><?= $obj->image ?></td>
                            <td><?= $obj->prix ?> €</td>

                            <td>
                                <a class="btn btn-primary btn-sm" href="platupdate.php?id=<?= $obj->id ?>"><span class="bi-pencil"></span> Modifier</a>
                            </td>
                            <td>
                            <a class="btn btn-primary btn-sm " onClick="return confirm('supprimer utilisateurs ?')" href="/controllers/deletplat.php?id=<?= $obj->id ?>"><span class="bi-pencil"></span> supprimer</a>

                        </td>
                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-fluid tab-pane" id="tab3" role="tabpanel">
        <h1>commande</h1>
        <div class="row cat">
            <table class="tab">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>utilisateur</th>
                        <th>plats</th>
                        <th>categrorie</th>
                        <th>quantité</th>
                        <th>total</th>
                        <th>date commande</th>
                        <th>etat de commande</th>
                        <th>menu</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($com as $comd) :
                        $obj = (object) $comd; ?>
                        <tr>
                            <td><?= $obj->id ?></td>
                            <td><?= $obj->nom_client ?></td>
                            <td><?= $obj->nom_plat ?></td>
                            <td><?= $obj->categorie ?></td>
                            <td><?= $obj->quantite ?></td>
                            <td><?= $obj->total ?> €</td>
                            <td><?= $obj->date_commande ?></td>
                            <td><?= $obj->etat ?></td>



                            <td>
                                <a class="btn btn-primary btn-sm" href="update.php?id='.$item['id'].'"><span class="bi-pencil"></span> Modifier</a>
                            </td>
                            <td>
                            <a class="btn btn-primary btn-sm " onClick="return confirm('supprimer utilisateurs ?')" href="/controllers/deletcom.php?id=<?= $obj->id ?>"><span class="bi-pencil"></span> supprimer</a>
                                
                            </td>
                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane" id="tab4" role="tabpanel">

        <h1>utilisateurs</h1>
        <a class="btn btn-primary btn-sm " href="update.php?id='.$item['id'].'">ajouter utilisateur</a>
        <div class="row cate">
            <table class="tab">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nom utilisateur</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>adresse</th>
                        <th>num</th>
                        <th>email</th>
                        <th>inscription</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($uti as $util) :
                        $obj = (object) $util; ?>
                        <tr>
                            <td><?= $obj->id ?></td>
                            <td><?= $obj->username ?></td>
                            <td><?= $obj->nom ?></td>
                            <td><?= $obj->prenom ?></td>
                            <td><?= $obj->adesse ?></td>
                            <td><?= $obj->num ?></td>
                            <td><?= $obj->mail ?></td>
                            <td><?= $obj->inscription ?></td>


                            <td>
                                <a class="btn btn-primary btn-sm" href="update.php?id='.$item['id'].'"><span class="bi-pencil"></span> Modifier</a>
                            </td>
                            <td>
                            <a class="btn btn-primary btn-sm " onClick="return confirm('supprimer utilisateurs ?')" href="/controllers/deleteuser.php?id=<?= $obj->id ?>"><span class="bi-pencil"></span> supprimer</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>






<?php
require_once "./controllers/footer_script.php";
?>

  <?php
} else {
  // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page d'accueil ou afficher un message d'erreur
  header("Location: index.php"); // Redirige vers la page d'accueil
  exit(); // Quitte le script pour éviter toute exécution supplémentaire
}
?>