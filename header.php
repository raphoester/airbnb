<?php include("inc/data.php");?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link href='https://css.gg/css' rel='stylesheet'>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="css/style.css">
    <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script src="semantic/dist/semantic.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<header>
<div class="shadow-sm p-3 mb-5 bg-white rounded">
    <nav>
        <ul class="nav justify-content-end">
            <a href="index.php"><img class="logo" src="img/logo_airbnb.jpg" alt="logo" href="index.php"></a>

        <?php
        if(empty($_SESSION["login"]))
        {?>

        <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="creercompte.php">Inscription</a>
        </li>
        <?php 
        }
        else if ($_SESSION["login"] == 1)
        {?>

        <li class ="nav-item">
            <p class="nav-link"><?php echo $donnees_utilisateur["capital"];?> €</p>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="nouvelleannonce.php">Poster une annonce</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="compte.php">Espace personnel</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="?dec=True">Déconnexion</a>
        </li>

        <?php } ?>
        </ul>
    </nav>
</div>
</header>


</html>