<?php
require_once"../../controllers/inscription_script.php";

// $titre doit etre donner avant header.php
$titre="Accueil";
include_once"../../controllers/head_script.php";
// on inclus la navbar
include_once"../../controllers/nav_script.php";

// contenu de la page
?>
<h1>Inscription</h1>

<form method="post">

<div>
    <label for="pseudo">pseudo</label>
    <input type="text" name="nickname" id="pseudo">    
</div>
<div>
    <label for="nom">nom</label>
    <input type="text" name="nom" id="nom">
</div>
<div>
    <label for="prenom">prénom</label>
    <input type="text" name="prenom" id="prenom">
</div>
<div>
    <label for="adresse">Adresse</label>
    <input type="text" name="adresse" id="adresse">
</div>
<div>
    <label for="num">numeros de tel</label>
    <input type="text" name="num" id="num">
</div>
<div>
    <label for="email">email</label>
    <input type="email" name="email" id="email">    
</div>
<div>
    <label for="pass">mots de passe</label>
    <input type="password" name="pass" id="pass">
</div>
<button type="submit">m'inscrire</button>




</form>

<?php
include_once"../../controllers/footer_script.php";
?>