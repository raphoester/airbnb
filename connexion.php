<?php include("inc/header.php");?>
<?php

if (!empty($_POST["email"]) && !empty($_POST["mdp"]))
{
    
    foreach ($pdo->query("SELECT email, mot_de_passe, id_utilisateur FROM utilisateur;") as $row)
    {
        if (($row["email"] == $_POST["email"]) && ($row["mot_de_passe"] == md5($_POST["mdp"])))
        {
            setcookie("email", $_POST["email"], time()+5000000, '/');
            setcookie("mdp", md5($_POST["mdp"]), time()+5000000, '/');
            $_SESSION["login"] = 1;
            $_SESSION["id"] = $row["id_utilisateur"];
            header("Location: compte.php");
            exit();
        }
    }
}

if (!empty($_COOKIE["email"]) && !empty($_COOKIE["mdp"]))
{
    foreach ($pdo->query("SELECT email, mot_de_passe, id_utilisateur FROM utilisateur;") as $row)
    {
        if (($row["email"] == $_COOKIE["email"]) && ($row["mot_de_passe"] == md5($_COOKIE["mdp"])))
        {
            $_SESSION["login"] = 1;
            $_SESSION["id"] = $row["id_utilisateur"];
            header("Location: compte.php");
            exit();
        }
    }
}
?>


<h1>Connexion à votre compte</h1>

<form action="" method ="POST">

    <label>Email</label>
    <input type="text" name = "email">
    
    <label>Mot de passe</label>
    <input type="password" name = "mdp">

    <input type ="submit">


</form>

<p>Vous préférez <a href="creercompte.php">créer un compte</a> ? :)</p>

<?php include("inc/footer.php");?>