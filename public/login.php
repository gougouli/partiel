<?php
session_start();

require_once "../functions/db.php";
$login = "";
$email = "";

if(!empty($_POST["login"])){$login = $_POST["login"];}
if(!empty($_POST["login"]) && !empty($_POST["pass"])){
    $password = $_POST["pass"];
    $db = dbConnect();

    $query = "SELECT * FROM users WHERE login = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$login]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        if($row['active']){
            $_SESSION['state'] = 'connected';
            $_SESSION['user_id'] = $row['ID'];
            $_SESSION['success'] = "Vous vous etes bien connecté !";
            $_SESSION['rank'] = $row['rank'];
            header('Location: /index.php');
        }else{
            $_SESSION['errors'] = "Votre compte est désactivé, contactez un administrateur !";
        }

    } else {
        $_SESSION['errors'] = "Le mot de passe ou le login est incorrect !";
    }
}

?>

<?php require_once "layout/header.php"; ?>
<!--++++++++++++++++++++++ Formulaire de connexion ===============================-->
<form class="col-md-12" method="POST">
    <div class="form-group ">
        <label for="exampleInputEmail1">Login</label>
        <input type="text" class="form-control" name="login" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $login; ?>" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control"  name="pass" id="exampleInputPassword1" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary">Valider</button>
    <?php if(!empty($_SESSION['errors'])){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['errors']; ?>
        </div>
    <?php } ?>
</form>
<!--++++++++++++++++++++++ Formulaire de connexion ===============================-->
<?php require_once "layout/footer.php"; ?>
