<?php
session_start();
//var_dump($_SESSION); 
use App\Autoloader;
use App\Models\CommandesModel;
use App\Models\UtilisateursModel;

require_once "../../Autoloader.php";
Autoloader::register();
//require_once "../../controllers/profilupdate.php";
if (isset($_SESSION['auth'])) {
  // L'utilisateur est connecté, permettre l'accès à la page du profil
?>
  <?php
  require_once "../../controllers/head_script.php";
  require_once "../../controllers/nav_script.php";
  $utimodel = new UtilisateursModel;
  $uti = $utimodel->find($_SESSION['auth']['id']);
  $commodel = new CommandesModel;
  $com = $commodel->comdid($_SESSION['auth']['id']);


  $obj = (object) $uti;
  $id = $obj->id;
  // var_dump($id)

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
              <li><h4>nom d'utilisateur :</h4> <?= $obj->username ?></li>
              <li><h4>nom : </h4><?= $obj->nom ?></li>
              <li><h4>Prenom: </h4><?= $obj->prenom ?></li>
              <li><h4>adresse : </h4><?= $obj->adesse ?></li>
              <li><h4>numero de telephone : </h4><?= $obj->num ?></li>
              <li><h4>adresse email : </h4><?= $obj->mail ?></li>
              <li><h4>inscrit depuis le : </h4><?= $obj->inscription ?></li>
            </ul>
            <p>* si vous souhaitez la supression de votre compte ainsi que les données contenu de celui-ci vous pouvez en faire la demande dans <a href="/content/user/contact.php">contact</a> </p>
            <p>* si vous souhaitez modifier vos informations, vous pouvez le faire dans modifier profil.</p>
          </div>
          <div class="tab-pane" id="tab2" role="tabpanel">
            <h1>historique de commande</h1>
            <table class="commandetab">
              <thead>
                <tr>
                  <th>nom du plat</th>
                  <th>categories</th>
                  <th>quantité</th>
                  <th>total en €</th>
                  <th>date</th>
                  <th>etat</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($com as $coms) :
                  $comObj = (object) $coms;
                  //var_dump($comObj)
                ?>
                  <tr>

                    <td><?= $comObj->nom_plat ?></td>
                    <td><?= $comObj->categorie ?></td>
                    <td><?= $comObj->quantite ?></td>
                    <td><?= $comObj->total ?>€</td>
                    <td><?= $comObj->date_commande ?> </td>
                    <td><?= $comObj->etat ?> </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="tab3" role="tabpanel">
            <h1>moyent de paiement</h1>
            <h1>la page est encore en cuisine hihi</h1>
          </div>
          <div class="tab-pane" id="tab4" role="tabpanel">
            <div class="container">
              <h1>modifier profil</h1>
              <form class="profil" action="../../controllers/profilupdate.php?id=<?= $obj->id ?>" method="post">
                <label for="username">nom d'utilisateur:</label>
                <input type="text" id="username" name="username" placeholder="<?= $obj->username ?>"value="<?=$obj->username?>">
                <label for="name">nom:</label>
                <input type="text" id="name" name="name" value="<?= $obj->nom ?>">
                <label for="nickname">prenom:</label>
                <input type="text" id="nickname" name="nickname" value="<?= $obj->prenom ?>">
                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" value="<?= $obj->adesse ?>">
                <label for="email">email:</label>
                <input type="email" id="email" name="email" value="<?= $obj->mail ?>">
                <label for="num">numero de tel:</label>
                <input type="text" id="num" name="num" value="<?= $obj->num ?>">
                <label for="pass">Mots de passe:</label>
                <input type="password" id="pass" name="pass" placeholder="votre mots de passe">
                <label for="pass_retake">confimaton mots de passe:</label>
                <input type="password" id="pass_retake" name="pass_retake" placeholder="confirmer le mots de passe">
                <input type="submit" class="btn btn-primary" value="modifier">
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

<?php
  require_once "../../controllers/footer_script.php";
} else {
  // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page d'accueil ou afficher un message d'erreur
  //header("Location: index.php"); // Redirige vers la page d'accueil
?><h1>connexion au profil refusé</h1>
<?php
  exit(); // Quitte le script pour éviter toute exécution supplémentaire
}
?>