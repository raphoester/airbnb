<?php include('inc/header.php');?>



<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();  
}

if (empty($_GET["id"]))
{
    header("location : 404.php");
    exit();
}



$sql = "select * from utilisateur where id_utilisateur = ".$_GET['id'].";";
$interlocuteur = (($pdo->query($sql))->fetchAll())[0];


if(!empty($_POST["message"])) //traitement du message envoyé en POST
{
    $message["message"] = str_replace("'", "\'", $_POST['message']);
    $message = str_replace('"', "\"", $_POST["message"]);

    $sql = "insert into message (date_envoi, contenu, id_expediteur, id_destinataire) values('".date('Y-m-d H:i:s')."', '".$message."', ".$donnees_utilisateur['id_utilisateur'].", ".$interlocuteur["id_utilisateur"].");";
    $pdo->exec($sql);

    $_POST["message"] = "";

}
var_dump($_POST);
$sql = "select * from message where id_expediteur = ".$donnees_utilisateur['id_utilisateur']." and id_destinataire = ".$interlocuteur['id_utilisateur']." order by date_envoi;";
$messages_recus = ($pdo->query($sql))->fetchAll();

$sql = "select * from message where id_destinataire = ".$donnees_utilisateur['id_utilisateur']." and id_expediteur = ".$interlocuteur['id_utilisateur']." order by date_envoi;";
$messages_envoyes = ($pdo->query($sql))->fetchAll();

$messages = array_merge($messages_envoyes, $messages_recus); 

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
            <h1>Messages avec <?php echo $interlocuteur["prenom"]?> :</h1>
        </div>
        <div>
            <?php
                for($i=0; $i<count($messages); $i++)
                {
                    if(($messages[$i]["id_expediteur"] == $interlocuteur["id_utilisateur"]) && ($messages[$i]["id_destinataire"] == $donnees_utilisateur["id_utilisateur"]))//si le message a été envoyé par l'interlocuteur
                    {
                        ?>
                        <div class= 'message'>
                            <p style="color:red;"><?php echo $messages[$i]["contenu"];?></p>
                        </div>
                    <?php
                    }
                    else
                    {?>
                        <div class= 'message'>
                            <p style="color:blue;"><?php echo $messages[$i]["contenu"];?></p>
                        </div>
                    <?php 
                    }
                }
                
            ?>
            <form action="" method = "POST">

                <label for="message"></label>
                <input type="text" id="message" name ='message'>

                <input type="submit" value = "Envoyer">
            </form>
        
        </div>
    </div>
</section>


<?php include('inc/footer.php');?>