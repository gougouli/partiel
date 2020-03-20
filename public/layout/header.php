<?php
// ==================== NEWSLETTER FORM ====================
require_once __DIR__."/../../functions/db.php";
if(!empty($_POST['email'])){
    $db= dbConnect();
    $stmt = $db->prepare("SELECT * FROM newsletter WHERE email = ?" );
    $stmt->execute([$_POST['email']]);
    if($stmt->rowCount() == 0){
        $stmt = $db->prepare("INSERT INTO newsletter (email) VALUE (?)");
        $stmt->execute([$_POST['email']]);
        $_SESSION['success'] = "Vous vous etes inscris à notre newsletter ! Merci";
    }else{
        $_SESSION['errors'] = "Vous etes déjà inscris à notre newsletter !";
    }

}
// ==================== NEWSLETTER FORM ====================
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

<?php require_once __DIR__ . "/nav.php"; ?>
<div class="container">
<!--    ==================== Message de succes ====================-->
    <?php if(!empty($_SESSION['success'])){
        ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success']; ?>
            <?php $_SESSION['success'] = ""; ?>
        </div>
    <?php } ?>
    <!--    ==================== Message de succes ====================-->

    <!--    ==================== Message d'error ====================-->
    <?php if(!empty($_SESSION['errors'])){
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['errors']; ?>
            <?php $_SESSION['errors'] = ""; ?>
        </div>
    <?php } ?>
    <!--    ==================== Message d'error ====================-->

    <!--    ==================== Corps de page ====================-->
    <div class="row">

