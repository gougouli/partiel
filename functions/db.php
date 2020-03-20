<?php


//POUR GAGNER DU TEMPS J'ai laisser le user en root meme si ce n'est pas sécurisé, mais je vais essayer de faire le panier rapidement
function dbConnect()
{
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=partiel",
            "root",
            ""
        );
        return $pdo;
    } catch(PDOException $ex) {

        exit("Erreur lors de la connexion à la base de données");
    }
}
function dbConnectPanier()
{
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=greg",
            "root",
            ""
        );
        return $pdo;
    } catch(PDOException $ex) {

        exit("Erreur lors de la connexion à la base de données");
    }
}
