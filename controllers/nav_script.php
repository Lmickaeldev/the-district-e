<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php"><img src="/assets/images/the_district_brand/logo_transparent.png" alt="" srcset=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/content/user/categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/content/user/plats.php">Plats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/content/user/contact.php">Contact</a>
                </li>
                
                
                
                
                <?php
                if (isset($_SESSION['auth']) && $_SESSION['auth']['role_id'] == 2) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/content/admin/admin.php">admin</a>
                    </li>
                    <?php
                }
                ?>

<?php

if (isset($_SESSION['auth'])) :
    $utilisateur = $_SESSION['auth']['username'];
    ?>
                    <li>
                        <a href="/content/user/profil.php"><?= $utilisateur ?></a>
                        <a href="/controllers/deconect_script.php"><input type="button" class="btn btn-secondary btn-sm" value="Deconnexion"></input></a>
                    </li>
                    <?php endif; ?>
                    <?php
                if (!isset($_SESSION['auth']) ) {
                    ?>
                    <li class="nav-item">
                        <a href="/content/user/connexion.php"><input type="button" class="btn btn-secondary btn-sm" value="connexion"></input></a>
                    </li>
                    <?php
                }
                ?>

                <li>
                <a href="/content/user/panier.php"><i class="fa fa-basket-shopping"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>