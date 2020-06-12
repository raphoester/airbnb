<?php include('inc/header.php'); ?>

<?php
$signalements_a_traiter = $pdo->query('select * from signalement where traitement = False order by id_signalement')->fetchAll();
?>
<section>
    <h1>
        Gestion des signalements
    </h1>
    <div>
        <h3>Signalements non traités :</h3>
    </div>
    <div>
        <ul>
        
            <?php
                for($i=0; $i<count($signalements_a_traiter); $i++)
                {
                    $message_signale = $pdo->query('select * from message where id_message = '.$signalements_a_traiter[$i]['id_message_signale'].";")->fetch();
                    $utilisateur_signalant = $pdo->query('select * from utilisateur where id_utilisateur ='.$message_signale["id_destinataire"].';')->fetch();
                    ?>
                    <li>
                        <h4><a href="traitersignalement.php?id=<?php echo $signalements_a_traiter[$i]['id_signalement'];?>"><?php echo "Signalement de ".$utilisateur_signalant['prenom']." ".$utilisateur_signalant['nom']." n° ".$signalements_a_traiter[$i]['id_signalement'];?></a></h4>
                    </li>
                    <?php
                }
            ?>
        </ul>
    </div>

</section>

<?php include('inc/footer.php'); ?>
