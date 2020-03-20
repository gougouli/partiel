<?php
// Avant session_start(), le tableau $_SESSION n'existe pas !
session_start();
// Une fois session_start exécuté, PHP, sur la base de l'identifiant de session, a créé le tableau $_SESSION
// et a rétabli les clés qu'on avait éventuellement définies avant
$_SESSION = [];
$_SESSION['success'] = "Vous vous etes bien déconnecté !";
header('Location: /index.php');
