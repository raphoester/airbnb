<?php include('inc/header.php');?>



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
    <div>
        <div>
            <a href="messages.php">◀️Retour à la liste des conversations</a>
            <h1>Conversation avec <a href="membre.php?id=<?php echo $interlocuteur['id_utilisateur'];?>"><?php echo $interlocuteur["prenom"]?></a> :</h1>
        </div>
        <div>
            <?php
                for($i=0; $i<count($messages); $i++)
                {
                    if(($messages[$i]["id_expediteur"] == $interlocuteur["id_utilisateur"]) && ($messages[$i]["id_destinataire"] == $donnees_utilisateur["id_utilisateur"]))//si le message a été envoyé par l'interlocuteur
                    {
                        ?>
                        <div class= 'message'>
                            <label for="message-contenu"><?php echo $messages[$i]["date_envoi"] ;?></label>
                            <p id="message-contenu" style="color:red;"><?php echo $messages[$i]["contenu"];?>
                            <a href="?id_message=<?php echo $messages[$i]["id_message"];?>&id=<?php echo $interlocuteur["id_utilisateur"];?>">❌</a>
                            <a href="signalement.php?id=<?php echo $messages[$i]["id_message"];?>">🚩</a>
                            </p> 
                        </div>
                    <?php
                    }
                    else
                    {?>
                        <div class= 'message'>
                            <label for="message-contenu"><?php echo $messages[$i]["date_envoi"] ;?></label>
                            <p id="message-contenu" style="color:blue;"><?php echo $messages[$i]["contenu"];?>
                            <a href="?id_message=<?php echo $messages[$i]["id_message"];?>&id=<?php echo $interlocuteur["id_utilisateur"];?>">❌</a>
                            </p> 
                        </div>
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
                <div>       
                
                    <form action="" method = "POST">
                        <label for="message"></label>
                        <input type="text" id="message" name ='message'>
                        <input type="submit" value = "Envoyer">
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
</section>


<?php include('inc/footer.php');?>