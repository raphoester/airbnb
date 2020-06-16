<?php include("inc/data.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/message.css">
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



<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();  
}

if (empty($_GET["id"]))
{
    header("Location : 404.php");
    exit();
}

if(!empty($_GET["id_message"])) //si il faut supprimer un message
{
    $sql = "select * from message where id_message = ". $_GET['id_message'].";";
    $message_a_supprimer = $pdo->query($sql)->fetch();
    if(gettype($message_a_supprimer) != 'boolean') // si la requête a abouti
    {
        if ($message_a_supprimer["id_expediteur"] == $donnees_utilisateur["id_utilisateur"] || $message_a_supprimer["id_destinataire"] == $donnees_utilisateur["id_utilisateur"])
        {
            $sql = "delete from message where id_message =". $_GET['id_message'].";";
            $pdo->exec($sql);
        }
        else
        {
            echo "<h4>Erreur lors de la suppression : ce message ne vous appartient pas.</h4>";
        }
    }

}


$sql = "select * from utilisateur where id_utilisateur = ".$_GET['id'].";";
$interlocuteur = (($pdo->query($sql))->fetchAll())[0];


if(!empty($_POST["message"]) && $_POST["message"] != "") //traitement du message envoyé en POST
{
    
    $message = str_replace("'", "\'", $_POST['message']);
    
    $message = str_replace('"', '\"', $message);
    
    $sql = "insert into message (date_envoi, contenu, id_expediteur, id_destinataire) values('".date('Y-m-d H:i:s')."', '".$message."', ".$donnees_utilisateur['id_utilisateur'].", ".$interlocuteur["id_utilisateur"].");";
    
    $pdo->exec($sql);

    $_POST["message"] = "";
} 

$sql = "select * from message where id_expediteur = ".$donnees_utilisateur['id_utilisateur']." and id_destinataire = ".$interlocuteur['id_utilisateur']." order by date_envoi;";
$messages_recus = ($pdo->query($sql))->fetchAll();

$sql = "select * from message where id_destinataire = ".$donnees_utilisateur['id_utilisateur']." and id_expediteur = ".$interlocuteur['id_utilisateur']." order by date_envoi;";
$messages_envoyes = ($pdo->query($sql))->fetchAll();

$messages = array_merge($messages_envoyes, $messages_recus);



if(!empty($_GET['debloque']) && $_GET['debloque'] == $interlocuteur['id_utilisateur']){//déblocage d'un utilisateur
    $sql = "update blocage set vraifaux = False where id_bloqueur = ".$donnees_utilisateur['id_utilisateur']." and id_bloque =". $interlocuteur['id_utilisateur'] .";";
    $pdo->exec($sql);
}

if(!empty($_GET['bloque']) && $_GET['bloque'] == $interlocuteur['id_utilisateur']){//bloquage d'un utilisateur
    $sql = "insert into blocage (id_bloqueur, id_bloque, vraifaux) values (".$donnees_utilisateur['id_utilisateur'].",". $interlocuteur['id_utilisateur'] .", True);";

    $pdo->exec($sql);
}

$sql = "select * from blocage where id_bloqueur = ". $donnees_utilisateur['id_utilisateur']." and vraifaux = True;";
$interlocuteurs_bloques = $pdo->query($sql)->fetchAll();



$sql = "select * from blocage where id_bloque = ". $donnees_utilisateur['id_utilisateur']." and vraifaux = True;";
$interlocuteurs_bloquants = $pdo->query($sql)->fetchAll();


 //tri permet d'assigner des indexs adaptatifs en fonction de la position de l'élément 
function tri($a,$b) 
{ 
    return ($a["date_envoi"] <= $b["date_envoi"]) ? -1 : 1; 
} 
usort($messages, "tri"); 


?>

<section>
<div class="main">
    <a href="messages.php">◀️Retour à la liste des conversations</a>
    <div class="ui placeholder segment">
        <div class="top">
            <h1 class="ui dividing header">Conversation avec <a href="membre.php?id=<?php echo $interlocuteur['id_utilisateur'];?>"><?php echo $interlocuteur["prenom"]?></a> :</h1>
        </div>
        <div class="message">
            <?php
                    for($i=0; $i<count($messages); $i++)
                    {
                        if(($messages[$i]["id_expediteur"] == $interlocuteur["id_utilisateur"]) && ($messages[$i]["id_destinataire"] == $donnees_utilisateur["id_utilisateur"]))//si le message a été envoyé par l'interlocuteur
                        {
                            ?>
                            <div>
                                <label for="message-contenu"><?php echo $messages[$i]["date_envoi"] ;?></label>
                                <p id="message-contenu" style="color:red;"><?php echo $messages[$i]["contenu"];?>
                                <a href="?id_message=<?php echo $messages[$i]["id_message"];?>&id=<?php echo $interlocuteur["id_utilisateur"];?>">❌</a>
                                <a href="signalement.php?id=<?php echo $messages[$i]["id_message"];?>">🚩</a>
                                </p> 
                            </div>
                            <div class="ui grey inverted segment"></div>
                        <?php
                        }
                        else
                        {?>
                            <div class="d-flex justify-content-end">
                                <ul class="test1">
                                    <li>
                                    <label for="message-contenu"><?php echo $messages[$i]["date_envoi"] ;?></label>
                                    </li>
                                    <li>
                                        <p id="message-contenu" style="color:blue;"><?php echo $messages[$i]["contenu"];?>
                                        <a href="?id_message=<?php echo $messages[$i]["id_message"];?>&id=<?php echo $interlocuteur["id_utilisateur"];?>">❌</a>
                                        </p> 
                                    </li>
                                </ul>
                            </div>
                            <div class="ui grey inverted segment"></div>
                        <?php 
                        }
                    }
            $bloque = False;
            for($j=0;$j<count($interlocuteurs_bloquants); $j++)
            {
                if ($interlocuteurs_bloquants[$j]['id_bloqueur'] == $interlocuteur['id_utilisateur'])
                {
                    //choix de la conjugaison en f° du sexe de l'utilisateur
                    $bloque = True;
                    if ($donnees_utilisateur['sexe'] == 'f')
                    {
                        $conjugaison = "e";
                    }
                    else
                    {
                        $conjugaison = "";
                    }
                    ?>
                    <div>
                        <p><?php echo $interlocuteur['prenom']." vous a bloqué".$conjugaison."."?></p>
                    </div>
                    <?php
                    break;
                }
            }

            for($j = 0; $j<count($interlocuteurs_bloques); $j++)
            {
                if ($interlocuteurs_bloques[$j]['id_bloque'] == $interlocuteur['id_utilisateur'])
                {
                    $bloque = True;
                    ?>
                    <div>
                        <p>Vous avez bloqué <?php echo $interlocuteur['prenom']?>.</p>
                        <a href="?debloque=<?php echo $interlocuteur['id_utilisateur'];?>&id=<?php echo $interlocuteur['id_utilisateur'];?>">Débloquer <?php echo $interlocuteur['prenom']?></a>
                    </div>
                    
                    <?php
                    break;
                }
            }

            if ($bloque == False)
            {?>
                <div class="test">       
                    <form action="" method = "POST">
                    <div class="form-group basic-textarea">
                        <textarea class="form-control pl-2 my-0" type="text" id="message" name ="message" rows="3" placeholder="Entrez votre message ici..."></textarea>
                        <input type="submit" value = "Envoyer" class="btn btn-primary">
                    </div>
                    </form>
                </div>
         
                <div>
                <a href="?bloque=<?php echo $interlocuteur['id_utilisateur'];?>&id=<?php echo $interlocuteur['id_utilisateur'];?>">Bloquer <?php echo $interlocuteur['prenom']?></a>   
                </div>
                <?php
            }
            ?>
        </div>

        
    </div>
</div>
</section>


<?php include('inc/footer.php');?>