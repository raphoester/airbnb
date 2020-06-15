<?php include('inc/header.php');?>
<?php 
    if (empty($_SESSION["login_adm"]) || $_SESSION["login_adm"] != 1)
    {
        header("Location: connexion.php");
        exit();   
    }

    if(empty($_GET))
    {
        header('location : administration.php');
        exit();
    }
    else if(!empty($_GET['id']))
    {
        $vide = False;
        $sql = 'select * from message m left join utilisateur u on (m.id_expediteur = u.id_utilisateur or m.id_destinataire = u.id_utilisateur) where u.id_utilisateur = '.$_GET["id"].' group by m.id_destinataire;';
        $messages_utilisateur = $pdo->query($sql)->fetchAll();
        if(empty($messages_utilisateur))
        {   ?>
            <h1>Cet utilisateur ne dispose d'aucun message.</h1>
            <?php
            $vide = True;
        }
    }
?>



<div>
<div>
<?php if($vide == False)
{?>
    <h1> Liste des conversations de <?php echo $messages_utilisateur[0]['prenom'] ?> :</h1>
    </div>
            <ul>
                <?php
                for($i = 0 ; $i < count($messages_utilisateur) ; $i++)
                {
                    if($messages_utilisateur[$i]['id_expediteur'] == $messages_utilisateur[$i]['id_utilisateur'])
                    {
                        $sql = 'select * from utilisateur where id_utilisateur = '.$messages_utilisateur[$i]['id_destinataire'].';';
                        $interlocuteur = $pdo->query($sql)->fetch();
    
                    }
                    else
                    {
                        $sql = 'select * from utilisateur where id_utilisateur = '.$messages_utilisateur[$i]['id_expediteur'].';';
                        $interlocuteur = $pdo->query($sql)->fetch();
                    }
                    
                    ?>
                    <li><a href="conversation_admin.php?de=<?php echo $messages_utilisateur[$i]['id_utilisateur'];?>&a=<?php echo $interlocuteur['id_utilisateur'];?>"><?php echo $interlocuteur['prenom'] ; ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
<?php
}
?>



<?php include('inc/footer.php');?>