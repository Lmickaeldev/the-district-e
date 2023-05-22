<?php
session_start();
  
 include_once"../../controllers/head_script.php";
 include_once"../../controllers/nav_script.php";
 
 
?>
<script src="../../assets/javascript/script.js"></script>
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

                    <form action="../../controllers/connexion_script.php" method="post" novalidate onsubmit="return validate();"> 
                        <div class="row mb-3">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
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
include_once"../../controllers/footer_script.php";
?>