<?php include("inc/data.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/membre.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
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
<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}

if(!empty($_GET["id"]))
{
    $infos = $pdo->query("select * from utilisateur where id_utilisateur = ". $_GET['id'].";")->fetch();
}

?>
<section>
    <div>
        <div>
            <h1>Profil de <?php echo $infos["prenom"];?></h1>
        </div>
        <div>
            <img class = "pdp" src="<?php echo $infos["image_profil"];?>" alt="" >
        </div>
        <div>
            <h5>Statut : <?php echo $infos["statut"];?></h5>
        </div>
        <a class = "ui big button" href="conversation.php?id=<?php echo $infos['id_utilisateur'];?>">Envoyer un message à <?php echo $infos["prenom"];?></a>
    </div>

</section>


<div class="editinfo">
    <div class="ui placeholder segment">
        <div class="column">
            <h3 class="ui dividing header">Éditer votre profil</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="ui form">
                    <div class="field">
                        <label for="nom">Nom</label>
                        <div class="ui left icon input">
                            <input type="text" name = "nom" id="nom" placeholder = "<?php echo $donnees_utilisateur['nom'];?>">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="prenom">Prenom</label>
                        <div class="ui left icon input">
                            <input type="text" name="prenom" id="prenom" placeholder = "<?php echo $donnees_utilisateur['prenom'];?>">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="courriel">Email</label>
                        <div class="ui left icon input">
                            <input type="email" name="email" id="email" placeholder = "<?php echo $donnees_utilisateur['email'];?>">
                            <i class="at icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="pdp">Image de profil (formats acceptés : jpg, jpeg, png, gif)</label>
                        <img class="pdp" style="width:50px" height="40px" src="<?php echo $donnees_utilisateur['image_profil'];?>" alt="photo de profil">
                        <div>
                            <input type="file" id="pdp" name="img"  placeholder ="modifier...">
                        </div>
                    </div>
                    <div class="field">
                        <label for="mdp1">Ancien mot de passe</label>
                        <div class="ui left icon input">
                            <input type="password" name="ancienMDP" id="mdp1">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="mdp2">Nouveau mot de passe</label>
                        <div class="ui left icon input">
                            <input type="password" name="nouveauMDP" id="mdp2">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="mdp2conf">Confirmation mot de passe</label>
                        <div class="ui left icon input">
                            <input type="password" name="nouveauMDPConf" id="mdp2conf">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <input class="ui blue submit button" type="submit" value="Confirmer la modification"></input>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("inc/footer.php");?>