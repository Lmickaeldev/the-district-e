<?php
session_start();
  
 include_once"./controllers/head_script.php";
 include_once"./controllers/nav_script.php";
 
 
?>
  <script>
    function validate()
{
  //ce sont ces deux variables qui vont stocker les messages d'erreur pour l'email et le mot de passe 
    var errorEmail="";
    var errorPass="";


    var email = document.getElementById( "inputEmail" );
    if( email.value == "" || email.value.indexOf( "@" ) == -1 )
    {
      
      errorEmail = "Vous devez saisir un email valide";
      document.getElementById( "error_email" ).innerHTML = errorEmail;
      return false;
    }

    var password = document.getElementById( "inputPassword" );
    if( password.value == "" || password.value < 6 )
    {
     
      errorPass = "Mot de passe incorrect!";
      document.getElementById( "error_pass" ).innerHTML = errorPass;
      return false;
    }

    else
    {
      return true;
    }
}

</script>
        <div class="container">

       
<?php if(isset($_SESSION['flash']['danger'])) {
    $message = $_SESSION['flash']['danger'];
    unset($_SESSION['flash']['danger']);

    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $message; ?>
    </div>
    
<?php }
?>

            <div class="row">
                <div class="col-8 mx-auto mt-5 mb-5">
                    <h4 class="text-center">connexion</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-9 mx-auto mt-4">
                    <!-- On a besoin des deux attributs - "action" et "post" -->
                    <!-- Quand le formulaire sera soumis, les données seront envoyées en post au fichier php "login.php" -->
                    <form action="./controllers/connexion_script.php" method="post" novalidate onsubmit="return validate();"> 
                        <div class="row mb-3">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <!-- On doit donner des noms aux champs de saisie pour que le serveur puisse les reconnaître et 
                                récupérer ainsi leurs valeurs (avec, par ex., $_POST['inputEmail'] ). 
                            -->
                            <input type="email" name="inputEmail" class="form-control" id="inputEmail" required>
                            <p id="error_email" ></p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                          <div class="col-sm-10">
                            <input type="password" name="inputPassword" class="form-control" id="inputPassword" required>
                          </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Se connecter">
                        <p id="error_pass" ></p>
                      </form>
                      <div class="col-6 mx-auto mt-4">
                      <p>pas encore inscrit ? / <a href="inscription.php">inscription</a></p>
                      <p>mots de passe perdu ? / <a href="#">ici</a></p>
                      </div>
                </div>
            </div>
        </div>
        
		
	</body>
</html>
<?php
include_once"./controllers/footer_script.php";
?>