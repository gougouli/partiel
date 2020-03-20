<?php
require_once "../../functions/db.php";
if(isset($_GET['id'])){
    $db = dbConnect();
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM newsletter WHERE id = ?");
    $stmt->execute([$id]);
    if($stmt->rowCount() == 1){
        $stmt = $db->prepare("DELETE FROM newsletter WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = "L'adresse mail a bien été supprimé de la newsletter!";
        header('Location: /admin/');
    }
}else{
    header("/admin/");
}
