<?php
session_start();
require_once "../../functions/db.php";
require_once "../../functions/admin.php";
if(isset($_GET['id'])){
    $id= $_GET['id'];
    $userinfo = getInfo($id);
}else{
    header("index.php");
}
//============================== MODIFICATION D'UTILISATEUR ==============================
if($_POST){
    $db = dbConnect();
    $login = $_POST['login'];
    $email = $_POST['email'];
    $active = $_POST['active'];
    $rank = $_POST['rank'];

    $stmt = $db->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$userinfo['login']]);
    if(!empty($_POST['pass'])){
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT, ['cost' => 12]);
    }else{
        $pass = $userinfo['password'];
    }
    if($stmt->rowCount() == 1){ // Si egal a 2 ca veut dire qu'on a deux user avec le meme login DONC PB et si 0 c'est que c'est bizarre
        $stmt = $db->prepare("UPDATE users SET login = ?, email = ?, password= ?, active = ?, rank = ?");
        $stmt->execute([$login, $email, $pass, $active, $rank]);
    }
}
//============================== MODIFICATION D'UTILISATEUR ==============================
$userinfo = getInfo($id); // on recupere les information pour eviter de recharger la page: pour comprendre retirer la ligne puis modifier un utlisateur

require_once "../layout/header.php";
?>

<!--//============================== Formulaire de  MODIFICATION D'UTILISATEUR ==============================-->
<h2 class="text-center col-md-12 mt-4">Modifier Utilisateur</h2>
<form class="col-md-12 p-5 text-center" method="post">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputEmail4">Login</label>
            <input type="text" name="login" value="<?= $userinfo['login']; ?>" class="form-control" id="inputEmail4" placeholder="Login">
        </div>
        <div class="form-group col-md-4">
            <label for="inputPassword4">Email</label>
            <input type="email" name="email" value="<?= $userinfo['email']; ?>" class="form-control" id="inputPassword4" placeholder="Email">
        </div>
        <div class="form-group col-md-4">
            <label for="inputPassword4">Password</label>
            <input type="password" name="pass" class="form-control" id="inputPassword4" placeholder="Vide = non changé">
        </div>
        <div class="input-group col-md-6">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Statut</label>
            </div>
            <select name="active" class="custom-select" id="inputGroupSelect01">
                <?php if($userinfo['active']){ ?>
                    <option selected value="1">Actif</option>
                    <option value="0">Non actif</option>
                <?php }else{ ?>
                    <option value="1">Actif</option>
                    <option selected value="0">Non actif</option>
                <?php } ?>
            </select>
        </div>
        <div class="input-group col-md-6">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Rang</label>
            </div>
            <select name="rank" class="custom-select" id="inputGroupSelect01">
                <?php if($userinfo['rank']){ ?>
                    <option selected value="1">Admin</option>
                    <option  value="0">Utilisateur</option>
                <?php }else{ ?>
                    <option value="1">Actif</option>
                    <option selected value="0">Non actif</option>
                <?php } ?>


            </select>
        </div>
    </div>
    <button type="submit" class=" mb-5  mt-5 btn btn-success">Modifier utilisateur</button>
</form>
<!--//============================== Formulaire de  MODIFICATION D'UTILISATEUR ==============================-->
<?php require_once "../layout/footer.php"; ?>
