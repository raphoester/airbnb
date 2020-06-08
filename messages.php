<?php include('inc/header.php');?>
<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}
$sql = "select * from message where id_expediteur = ".$donnees_utilisateur['id_utilisateur']." order by date_envoi desc;";
$envois = $pdo->query($sql);
$messages_envoyes = $envois->fetchAll();

$sql = "select * from message where id_destinataire = ".$donnees_utilisateur['id_utilisateur']." order by date_envoi desc;";
$receptions = $pdo->query($sql);
$messages_recus = $receptions->fetchAll();

// liste correspondants : tableau dont l'index est des id d'utilisateur. Valeur : true si une conversation a déjà été lancée.
$liste_correspondants = array();
for ($i = 0; $i < count($messages_envoyes); $i++)
{
    $liste_correspondants[$messages_envoyes[$i]['id_destinataire']] = True;
}

for($i = 0; $i<count($messages_recus); $i++)
{
    $liste_correspondants[$messages_recus[$i]["id_expediteur"]] = True;
}
$max_index = max(array_keys($liste_correspondants));
?>


<section>
    <div>
        <div>
            <h1>Messages</h1>
        </div>
    </div>
    <div>
        <ul>
        
        
            <?php
            for($i=0;$i<=$max_index; $i++)
            {
                if (!empty($liste_correspondants[$i]) && $liste_correspondants[$i] == True)
                {
                    $correspondant = $pdo->query("select * from utilisateur where id_utilisateur =". $i.";");
                    $correspondant = $correspondant->fetchAll();


                    $sql = "select * from message where (id_expediteur = ".$donnees_utilisateur['id_utilisateur']." and id_destinataire = ".$correspondant[0]['id_utilisateur'].") OR (id_destinataire = ".$donnees_utilisateur['id_utilisateur']." and id_expediteur = ".$correspondant[0]['id_utilisateur'].") order by date_envoi desc;";


                    $message_courant = $pdo->query($sql);
                    $message_courant = $message_courant->fetchAll();


                    if(empty($messages_recus[0]) || $messages_envoyes["0"]["date_envoi"] > $messages_recus["0"]["date_envoi"])//si le dernier message a été expédié par l'utilisateur
                    {
                        $message_a_afficher = $message_courant[0]["contenu"];

                    }
                    else //sinon : si le dernier message vient du gars en face
                    {
                        $message_a_afficher = $message_courant[0]["contenu"];

                    }
                    ?>
                        <li>
                            <h4>
                            <a href="conversation.php?id=<?php echo $correspondant[0]["id_utilisateur"];?>"><?php echo $correspondant[0]["prenom"]; ?></a>
                            </h4>
                            <p><?php echo $message_a_afficher?></p>
                        </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</section>



<?php include('inc/footer.php');?>