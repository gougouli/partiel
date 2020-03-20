<?php
require_once "../../functions/db.php";
if(isset($_GET['id'])){
    $db = dbConnect();
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    if($stmt->rowCount() == 1){
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = "Le compte utilisateur a bien été supprimé !";
        header('Location: /admin/');
    }
}else{
    header("/admin/");
}
