<?php include('inc/header.php'); ?>

<?php
    if(!empty($_GET['id'])){

        $_GET['id'] = mysqli_real_escape_string($mysqli, $_GET['id']);
        $sql = "select * from signalement where id_signalement = ".$_GET['id'].";";
        $signalement = $pdo->query($sql)->fetch();
        
        $sql = "select * from message where id_message = ".$signalement['id_message_signale'].";";
        $message_signale = $pdo->query($sql)->fetch();
        
        $sql = "select * from utilisateur where id_utilisateur = ".$message_signale['id_destinataire'].";";
        $signaleur =  $pdo->query($sql)->fetch();

        $sql = "select * from utilisateur where id_utilisateur = ".$message_signale['id_expediteur'].";";
        $coupable =  $pdo->query($sql)->fetch();
        
        if($signalement['traitement'])
        {
            header('location : signalements.php');
        }

        if(!empty($_POST))
        {
            switch ($_POST['pntion_exp'])
            {
                case 'bannir':
                    $sql = 'update utilisateur set banni = True where id_utilisateur = '. $coupable["id_utilisateur"].';';
                    echo $sql;
                    $pdo->exec($sql);
                break;
                case 'exclure':
                    $date_fin = strtotime("+7 day");
                    $sql = 'update utilisateur set date_fin_exclusion ="'.date("Y-m-d H:i:s", $date_fin).'" where id_utilisateur = '. $coupable["id_utilisateur"].';';
                    $pdo->exec($sql);
                break;
            }
            switch ($_POST['pntion_dst'])
            {
                case 'bannir':
                    $sql = 'update utilisateur set banni = True where id_utilisateur = '. $signaleur["id_utilisateur"].';';
                    $pdo->exec($sql);
                break;
                case 'exclure':
                    $date_fin = strtotime("+7 day");
                    $sql = 'update utilisateur set date_fin_exclusion ="'.date("Y-m-d H:i:s", $date_fin).'" where id_utilisateur = '. $signaleur["id_utilisateur"].';';
                    $pdo->exec($sql);
                break;
            }
            if (!empty($_POST['supprimer_message']) && $_POST['supprimer_message'] == "on")
            {
                $pdo->exec('update message set contenu = "<p style = \'color : red;\'><strong><i>Ce message a été supprimé par un administrateur car il ne respecte pas les règles de la communauté.</i></strong></p>" where id_message = '.$message_signale["id_message"]).';'; 
            }  

            $pdo->exec('update signalement set traitement = True where id_signalement = '.$signalement["id_signalement"].';');
        }
    }
    else
    {
        header ("Location : signalements.php");
    }
?>
<section>
    <a href="signalements.php">◀️Retour à la liste des signalements</a>
    <h1>
        Détails du signalement n°<?php echo $signalement['id_signalement'] ;?>
    </h1>
        <div>
            <div>
                <h5>Auteur du message :</h5><p><?php echo $coupable['prenom'];?></p>
            </div>
            <div>
                <h5>Destinataire : </h5><p><?php echo $signaleur['prenom'];?></p>
            </div>
            <div>
                <h5>Contenu du message : </h5><p><?php echo $message_signale['contenu'];?></p>
            </div>
            <div>
                <h5>Motif du signalement : </h5><p><?php echo $signalement['motif'];?></p>
            </div>
            <div>
                <h5>Description : </h5><p><?php echo $signalement['description'];?></p>
            </div>
            <div>
                <a href="" class = "ui big button">Examiner la conversation</a>
            </div>
            
        </div>

    <div>
        <h3>
            Quelle sentence appliquer ?    
        </h3>
        
        <form action="" method = "POST">

            <label for="punition_exp">Sanction de l'expéditeur du message : </label><br>
                <select name="pntion_exp" id="pntion_exp">
                    <option value="bannir">Bannir</option>
                    <option value="exclure">Exclure 7 jours</option>
                    <option value="rein">Ne rien faire</option>
                </select><br>
            <label for="punition_dst">Sanction de l'auteur du signalement : </label><br>
                <select name="pntion_dst" id="pntion_dst">
                    <option value="bannir">Bannir</option>
                    <option value="exclure">Exclure 7 jours</option>
                    <option value="rien">Ne rien faire</option>
                </select><br>
            <label for="supprimer_message">Supprimer le message concerné ? </label>
            <input type="checkbox" name="supprimer_message" id="sprmessage"><br>
            <input type="submit" value="Rendre justice" class='ui big button'>
        </form>
    </div>

</section>
<?php include('inc/footer.php'); ?>
