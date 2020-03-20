<?php

require_once "../functions/voiture.php";
$cars = getCars();
$panier = getPanier();
require_once 'layout/header.php'; ?>



<h2 class="col-md-12 text-center">Mon panier</h2>
<?php
if ($panier){ ?>
    <table class="table">
        <thead class=" table-dark">
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Année de sortie</th>
            <th scope="col">Nombre de kilomètres</th>
            <th scope="col">Prix</th>
            <th scope="col">Visible</th>
            <th scope="col">Panier</th>
        </tr>

        </thead>
        <?php

        var_dump($panier);
        foreach ($panier as $car){
            $car = getById($car);
            ?>
            <tr>
                <td><?= $car['nom']; ?></td>
                <td><?= $car['annee_sortie']; ?></td>
                <td><?= $car['nb_km']; ?></td>
                <td><?= $car['prix']; ?></td>

                <?php
                if($car['visible']){
                    ?>
                    <td>Oui</td>
                <?php }else{ ?>
                    <td>Non</td>
                <?php }
                ?>
                <td><a type="button" href="removefrompanier.php?id=<?= $car['ID']; ?>" class="btn btn-primary">Retirer</a></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <th>Prix TOTAL/</th>
            <td class="text-center" colspan="4"><?= getTotal(); ?></td>
        </tr>
    </table>

    <a type="button" href="clearpanier.php" class="btn btn-danger">Supprimer le panier</a>
<?php }else{ ?>
    <div class="text-center alert alert-danger col-md-12" role="alert">
        Panier vide. Remplissez le vite !
    </div>
<?php } ?>


<h2 class="col-md-12 text-center">Listes des voitures</h2>
<table class="table">
    <thead class=" table-dark">
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Année de sortie</th>
        <th scope="col">Nombre de kilomètres</th>
        <th scope="col">Prix</th>
        <th scope="col">Visible</th>
        <th scope="col">Panier</th>
    </tr>

    </thead>
    <?php
    foreach ($cars as $car){
        ?>
        <tr>
            <td><?= $car['nom']; ?></td>
            <td><?= $car['annee_sortie']; ?></td>
            <td><?= $car['nb_km']; ?></td>
            <td><?= $car['prix']; ?></td>
            <?php
            if($car['visible']){
                ?>
                <td>Oui</td>
            <?php }else{ ?>
                <td>Non</td>
            <?php }
            ?>
            <td><a type="button" href="addtopanier.php?id=<?= $car['ID']; ?>" class="btn btn-primary">Ajouter</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php require_once 'layout/footer.php'; ?>
