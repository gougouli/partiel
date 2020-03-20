<?php
session_start();


require_once "../functions/db.php";
$login = "";
$email = "";

if(!empty($_POST["login"])){$login = $_POST["login"];}
if(!empty($_POST["email"])){$email = $_POST["email"];}

if(!empty($_POST["email"]) && !empty($_POST["login"]) && !empty($_POST["repass"]) && !empty($_POST["pass"])){
    $pass = $_POST["pass"];
    $repass = $_POST["repass"];
    $db = dbConnect();
    $stmt = $db->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    if($stmt->rowCount() == 0){
        if($pass == $repass){
            $lastpass = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 12]);
            $stmt = $db->prepare("INSERT INTO users (login, password, email, active) VALUES ( ?, ?, ?, ?)");
            $stmt->execute([$login,$lastpass, $email, 1]);
            if($stmt){
                $_SESSION['success'] = "Vous vous etes inscris ! Connectez-vous maintenant.";
                header('Location: /index.php');
            }else{
                $_SESSION['errors'] = "Une erreur s'est produit veuillez rééssayez !";
            }

        }else{
            $_SESSION['errors'] = "Les mots de passe sont différents !";
        }
    }else{
        $_SESSION['errors'] = "A compte avec ce login existe déjà !";
    }
}

?>

<?php require_once "layout/header.php"; ?>

<form class="col-md-12" method="POST">
    <div class="form-group ">
        <label for="exampleInputEmail1">Login</label>
        <input type="text" class="form-control" name="login" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $login; ?>" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $email; ?>" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control"  name="pass" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Confirm Password</label>
        <input type="password" class="form-control" name="repass" id="exampleInputPassword1" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <?php if(!empty($_SESSION['errors'])){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['errors']; ?>
            <?php $_SESSION['errors'] = ""; ?>
        </div>
    <?php } ?>
</form>

<?php require_once "layout/footer.php"; ?>
