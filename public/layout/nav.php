<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">PARTIEL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/shop.php">Panier (en cours)</a>
            </li>
            <?php if(!isset($_SESSION['state'])){ ?><!-- Si il est connecté on cache inscription et connexion-->
                <li class="nav-item">
                    <a class="nav-link" href="/register.php">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login.php">Connexion</a>
                </li>
            <?php } ?>
            <?php if(isset($_SESSION['rank']) && $_SESSION['rank'] == 1){ ?><!-- Si il est admin on montre administration-->
                <li class="nav-item">
                    <a class="nav-link" href="/admin/">Administration</a>
                </li>
            <?php }
            if(isset($_SESSION['state']) && $_SESSION['state'] == "connected"){ ?> <!-- Si il est connecté on montre deconnexion -->
            <li class="nav-item">
                <a class="nav-link" href="/logout.php">Deconnexion</a>
            </li>
            <?php } ?>

        </ul>
    </div>
</nav>
