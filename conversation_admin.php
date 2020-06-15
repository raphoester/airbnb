<?php include('inc/header.php');?>

<?php 
    if (empty($_SESSION["login_adm"]) || $_SESSION["login_adm"] != 1)
    {
        header("Location: connexion.php");
        exit();   
    }

    if(empty($_GET) || empty($_GET['a']) || empty($_GET['de']))
    {
        header('location : administration.php');
        exit();
    }
    else
    {
        $utilisateur = $pdo->query("select * from utilisateur where id_utilisateur = ".$_GET['de'].";")->fetch();
        $interlocuteur = $pdo->query("select * from utilisateur where id_utilisateur = ".$_GET['a'].";")->fetch();
        $sql = "select * from message where (id_destinataire = ".$utilisateur['id_utilisateur']." and id_expediteur = ".$interlocuteur['id_utilisateur'].") or (id_expediteur = ".$utilisateur['id_utilisateur']." and id_destinataire = ".$interlocuteur['id_utilisateur']." ) order by date_envoi desc;";
        $messages = $pdo->query($sql)->fetchAll();

        ?>
        <section>
            <div><h1>Conversation entre <?php echo $utilisateur['prenom']?> et <?php echo $interlocuteur['prenom']?> : </h1></div>
                <div>
                    <ul>
                        <?php 
                        for($i = 0 ; $i < count($messages) ; $i++)
                        {
                            ?>
                                <li>
                                    <div>
                                        <?php echo $messages[$i]['date_envoi'];?>
                                    </div>
                                    <div>
                                        <?php echo $messages[$i]['contenu'];?>
                                    </div>
                                </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
        </section>
        <?php
    }
?>

<?php include('inc/footer.php'); ?>