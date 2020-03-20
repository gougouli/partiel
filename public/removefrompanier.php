<?php
require_once "../functions/voiture.php";
if(isset($_GET['id'])){
    removePanier($_GET['id']);
    $voiture = getById($_GET['id']);
    $_SESSION['success'] = "La voiture ".$voiture['nom']. " a été retiré au panier !";
    header('Location: /shop.php');
}else{
    header('Location: /');
}

