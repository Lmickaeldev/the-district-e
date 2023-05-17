<?php
session_start();
//var_dump($_SESSION); 
use App\Autoloader;
use App\Models\CommandesModel;
use App\Models\UtilisateursModel;

require_once "./Autoloader.php";
Autoloader::register();

if (isset($_SESSION['auth'])) {
  // L'utilisateur est connecté, permettre l'accès à la page du profil
?>
  <?php
  require_once "./controllers/head_script.php";
  require_once "./controllers/nav_script.php";
  $utimodel = new UtilisateursModel;
  $uti = $utimodel->find($_SESSION['auth']['id']);
  $commodel = new CommandesModel;
  $com = $commodel->comdid($_SESSION['auth']['id']);
  
  //var_dump($com);

  $obj = (object) $uti;
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <h1>Profil :<?= $obj->username ?> </h1>
        <div id="navbarNav">
          <ul class="nav" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab1" role="tab">profil</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab2" role="tab">historique commande</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab3" role="tab">payement</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab4" role="tab">modifier profil</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">

        <div class="tab-content">
          <div class="container-fluid tab-pane active" id="tab1" role="tabpanel">
            <h1>Profil</h1>
            <ul>
              <li>nom d'utilisateur : <?= $obj->username ?></li>
              <li>nom : <?= $obj->nom ?></li>
              <li>Prenom: <?= $obj->prenom ?></li>
              <li>adresse : <?= $obj->adesse ?></li>
              <li>numero de telephone : <?= $obj->num ?></li>
              <li>adresse email : <?= $obj->mail ?></li>
              <li>inscrit depuis le : <?= $obj->inscription ?></li>
            </ul>
          </div>
          <div class="tab-pane" id="tab2" role="tabpanel">
            <h1>historique de commande</h1>
            
          </div>
          <div class="tab-pane" id="tab3" role="tabpanel">
            <h1>moyent de paiement</h1>
          </div>
          <div class="tab-pane" id="tab" role="tabpanel">
            <h1>modifier profil</h1>
          </div>
        </div>

      </div>
    </div>
  </div>




































<?php
  require_once "./controllers/footer_script.php";
} else {
  // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page d'accueil ou afficher un message d'erreur
  //header("Location: index.php"); // Redirige vers la page d'accueil
?><h1>connexion au profil refusé</h1>
<?php
  exit(); // Quitte le script pour éviter toute exécution supplémentaire
}
?>