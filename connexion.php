<?php include("inc/data.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    
    <script
      src="https://kit.fontawesome.com/c96b06a653.js"
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="css/login.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    
    <script src="semantic/dist/semantic.min.js"></script>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
</head>
<body>
<header>
    <div class="logo">
        <a href="index.php">
            <img src="img/logo_airbnb.jpg" alt="logo" href="index.php">
        </a>
    </div>
</header>


<div class="login">

    <div class="ui placeholder segment">
        <div class="ui two column very relaxed stackable grid">
            <div class="column">
                <h3 class="ui dividing header">Se connecter</h3>
                <form action="" method ="POST">
                    <div class="ui form">
                        <div class="field">
                            <label>E-mail</label>
                            <div class="ui left icon input">
                                <input type="text" name = "email">
                                <i class="user icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label>Mot de passe</label>
                            <div class="ui left icon input">
                                <input type="password" name="mdp">
                                <i class="lock icon"></i>
                            </div>
                        </div>
                        <div class="ui left icon input">
                        <i class="sign in icon"></i>
                            <input class="ui blue submit button" type="submit" value="Valider">
                        </div>  
                    </div>
                </form>
            </div>
            <div class="middle aligned column">
                <h3 class="ui dividing header">Créer un compte</h3>
                <a class="ui big button" href="creercompte.php">
                    <i class="signup icon"></i>
                    S'inscrire
                </a>
            </div>
        </div>
        <div class="ui vertical divider">
            Ou
        </div>
    </div>
</div>
</body>



<?php

if (!empty($_POST["email"]) && !empty($_POST["mdp"]))
{
    
    foreach ($pdo->query("SELECT * FROM utilisateur;") as $row)
    {
        if (($row['banni'] == "0") && ($row['date_fin_exclusion'] < date('Y-m-d H:i:s')) && ($row["email"] == $_POST["email"]) && ($row["mot_de_passe"] == md5($_POST["mdp"])))
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
    foreach ($pdo->query("SELECT * FROM utilisateur;") as $row)
    {
        echo "<br><br>";
        if ( ($row["email"] == $_COOKIE["email"]) && ($row["mot_de_passe"] == md5($_COOKIE["mdp"])))
        {
            $_SESSION["login"] = 1;
            $_SESSION["id"] = $row["id_utilisateur"];
            //header("Location: compte.php");
            //exit();
        }
    }
}

// if (!empty($_POST["email"]) && !empty($_POST["mdp"]))
// {
    
//     foreach ($pdo->query("SELECT * FROM admin ;") as $row)
//     {
//         if (($row["email"] == $_POST["email"]) && ($row["mot_de_passe"] == md5($_POST["mdp"])))
//         {
//             $_SESSION["login_adm"] = 1;
//             $_SESSION["id_adm"] = $row["id_admin"];
//             header("Location: administration.php");
//             exit();
//         }
//     }
// }


?>


<?php include("inc/footer.php");?>