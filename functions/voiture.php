<?php
session_start();
require_once 'db.php';


//function addcar($name, $years, $km){
//    $prix = setPrice($years, $km);
//    $db = dbConnect();
//    $query = "INSERT INTO voiture (nom, annee_sortie, nb_km, prix) VALUES (?, ?, ?, ?)";
//    $req = $db->prepare($query);
//    $req->execute([$name,$years,$km,$prix]);
//    return $req;
//}
function setPrice($years, $km){
    $prix = $km/10000 * $years;
    return $prix;
}
function getCars($isActive = 2){
    $db = dbConnectPanier();
    if($isActive == 2 ){
        $query = "SELECT * FROM voiture";
        $req = $db->query($query);
    }else{
        $query = "SELECT * FROM voiture WHERE visible = ?";
        $req = $db->prepare($query);
        $req->execute([$isActive]);
    }
    if($req->rowCount() == 0){
        return 0;
    }
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function deleteCar($id){
    $db = dbConnectPanier();
    $query ="DELETE FROM voiture WHERE id = ?";
    $req = $db->prepare($query);
    $req->execute([$id]);
    return $req->fetchAll(PDO::FETCH_ASSOC);

}
function getById($id){
    $db = dbConnectPanier();
    $query = "SELECT * FROM voiture WHERE id = ?";
    $req = $db->prepare($query);
    $req->execute([$id]);
    return $req->fetch();
}
function getByNom($name){
    $db = dbConnectPanier();
    $query = "SELECT * FROM voiture WHERE nom LIKE :search";
    $req = $db->prepare($query);
    $req->execute([
        'search' => "%$name%"
    ]);
    if($req->rowCount() == 0){
        return 0;
    }
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
function updateCar($id, $name, $years, $km, $visible){
    $db = dbConnectPanier();
    $query ="UPDATE voiture SET nom = ?, annee_sortie = ?, nb_km = ?, visible = ?, prix = ?  WHERE id = ? ";
    $req = $db->prepare($query);
    $prix = setPrice($years, $km);
    $req=$req->execute([$name,$years,$km,$visible, $prix, $id]);
    return $req;
}
function addPanier($id){
    if(!$_SESSION['panier']){
        $_SESSION['panier'] = [];
        $_SESSION['panier'][] = 'voiture';
    }
    $_SESSION['panier']["voiture"][] = $id;
    return 1;
}

function getPanier(){
    if(!empty($_SESSION['panier']['voiture'])){
        return $_SESSION['panier']['voiture'];
    }else{
        return 0;
    }

}

function deletePanier()
{
    $_SESSION['panier'] = "";
    $_SESSION["success"] = "Votre panier a bien été supprimé.";
    header("Location: /shop.php");
}

function getTotal(){
    $somme = 0;
    foreach ($_SESSION['panier']['voiture'] as $id){
        $cars = getById($id);
        $somme += $cars['prix'];
    }
    return $somme;

}
function removePanier($id){
    unset($_SESSION['panier']['voiture'][array_search($id, $_SESSION['panier']['voiture'])]);
    echo "enelever";
}
