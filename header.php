<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
    <header>
        <ul>
            <li>
                <a href="index.php"><img src="img/logo_airbnb.jpg" alt="" width = 100px></a>
            </li>
            <li>
                <ul>
                <?php 
                session_start();
                $pdo = new PDO("mysql:host=localhost;dbname=airbnb", "root", "" , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                if(empty($_SESSION["login"]))
                {?>
                    <li>
                    <a href="connexion.php">Se connecter</a>
                    </li>
                    <li>
                        <a href="creercompte.php">Créer un compte</a>
                    </li>
                <?php
                }
                else if ($_SESSION["login"] == 1)
                {?>
                    <li>
                        <a href="nouvelleannonce.php">Poster une annonce</a>
                    </li>
                    <li>
                        <a href="compte.php">Espace personnel</a>
                    </li>
                <?php }?>
                </ul>
            </li>
        </ul>
    </header>
