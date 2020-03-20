<?php
session_start();


if($_SESSION['rank'] != 1){ // L'utilisateur n'est il pas un admin ?
    header('Location: /');  // Si non admin, redirection jusqua accueil
    exit(); //protection contre ceux qui evite les redirections
}
require_once "../../functions/db.php";
require_once "../../functions/admin.php";
$userlist = recoverUser(); // recuperation de tous les utilisaturs
$newsletterlist = recoverUserNewLetter(); // Recupération des email de newletter

// On initialise ici pour pouvoir les echo dans les value des input
$login = "";
$email = "";

//var_dump($_POST);
if(!empty($_POST["login"])){$login = $_POST["login"];} // on met a jour les variable  pour pouvoir les echo dans les value des input
if(!empty($_POST["email"])){$email = $_POST["email"];}// on met a jour les variable  pour pouvoir les echo dans les value des input

//============================== creation d'un nouvelle utlisateur ==============================
if(!empty($_POST["email"]) && !empty($_POST["login"]) && !empty($_POST["pass"])){
    $pass = $_POST["pass"];
    $active = $_POST["active"];
    $rank = $_POST["rank"];

    $db = dbConnect();
    $stmt = $db->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    if($stmt->rowCount() == 0){ // on test si aucun compte avec ce login existe
        $lastpass = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $db->prepare("INSERT INTO users (login, password, email, active, rank) VALUES ( ?, ?, ?, ?, ?)");
        $stmt->execute([$login,$lastpass, $email, $active, $rank]);
        if($stmt){
            $_SESSION['success'] = "Vous avez créez un nouveau compte.";
            $login = "";
            $email = "";
        }else{
            $_SESSION['errors'] = "Une erreur s'est produit veuillez rééssayez !";
        }
    }else{
        $_SESSION['errors'] = "Un compte avec ce login existe déjà !";
    }
}
//============================== creation d'un nouvelle utlisateur ==============================
$userlist = recoverUser(); // on met a jour la liste des utlisateurs dans le cas ou on vient de créer un utlisateur, ca evite de rafraichir la page
?>

<?php require_once "../layout/header.php"; ?>

<!--//============================== Formulaire de création d'un nouvel utilisateur ==============================-->
<h2 class="text-center col-md-12 mt-4">Nouvel Utilisateur</h2>
<form class="col-md-12 p-5 text-center" method="post">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputEmail4">Login</label>
            <input type="text" name="login" value="<?= $login; ?>" class="form-control" id="inputEmail4" placeholder="Login">
        </div>
        <div class="form-group col-md-4">
            <label for="inputPassword4">Email</label>
            <input type="email" name="email" value="<?= $email; ?>" class="form-control" id="inputPassword4" placeholder="Email">
        </div>
        <div class="form-group col-md-4">
            <label for="inputPassword4">Password</label>
            <input type="password" name="pass" class="form-control" id="inputPassword4" placeholder="Password">
        </div>
        <div class="input-group col-md-6">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Statut</label>
            </div>
            <select name="active" class="custom-select" id="inputGroupSelect01">
                <option selected value="1">Actif</option>
                <option value="0">Non actif</option>
            </select>
        </div>
        <div class="input-group col-md-6">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Rang</label>
            </div>
            <select name="rank" class="custom-select" id="inputGroupSelect01">
                <option value="1">Admin</option>
                <option selected value="0">Utilisateur</option>
            </select>
        </div>
    </div>
    <button type="submit" class=" mb-5  mt-5 btn btn-success">Créer utilisateur</button>
</form>
<!--//============================== Formulaire de création d'un nouvel utilisateur ==============================-->


<!--//============================== LISTE utilisateur ==============================-->
<h2 class="text-center col-md-12 mt-4">Liste Utilisateur</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Login</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
        <th scope="col">Rang</th>
        <th scope="col">Option 1</th>
        <th scope="col">Option 2</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($userlist as $user){ ?>
        <tr>
            <th><?= $user['ID']; ?></th>
            <td><?= $user['login']; ?></td>
            <td><?= $user['email']; ?></td>
            <?php if($user['active']){ ?>
                <td>Activé</td>
            <?php }else{ ?>
                <td>Désactivé</td>
            <?php } ?>
            <?php if($user['rank']){ ?>
                <td>Admin</td>
            <?php }else{ ?>
                <td>Utilisateur</td>
            <?php } ?>
            <td><a href="customuser.php?id=<?= $user['ID']; ?>" type="button" class="btn btn-warning">Modifier</a></td>
            <td><a href="deluser.php?id=<?= $user['ID']; ?>" type="button" class="btn btn-danger">Supprimer</a></td>
        </tr>
    <?php } ?>

    </tbody>
</table>
<!--//============================== LISTE utilisateur ==============================-->

<!--//============================== LISTE NEWSLETTER ==============================-->
<h2 class="text-center col-md-12 mt-4">Liste Newsletter</h2>
<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Email</th>
        <th scope="col">Option</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($newsletterlist as $user){ ?>
        <tr>
            <td><?= $user['ID']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><a type="button" href="newslettersup.php?id=<?= $user['ID']; ?>" class="btn btn-danger">Supprimer</a></td>
        </tr>
    <?php } ?>

    </tbody>
</table>
<!--//============================== LISTE NEWSLETTER ==============================-->
<?php require_once "../layout/footer.php"; ?>
