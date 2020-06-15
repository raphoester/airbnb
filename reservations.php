<?php include("inc/header.php");?>

<?php 
if(empty($_SESSION["login"]))
{
    header("location : connexion.php");
}

$sql = "select * from reservation left join annonce on annonce.id_annonce = reservation.id_annonce_reservee left join utilisateur on utilisateur.id_utilisateur = annonce.id_publicateur where id_reservant = ".$donnees_utilisateur['id_utilisateur']." order by id_reservation desc;";
$reservations = $pdo->query($sql)->fetchAll();

$conjugaison ="";
if($donnees_utilisateur['sexe'] = 'f')
{
    $conjugaison = "e";
}

if(!empty($_GET) && !empty($_GET['annule']))
{
    $sql = "select * from reservation where id_reservation = ".$_GET['annule'].";";
    $reservation_a_annuler = $pdo->query($sql)->fetch();

    $sql = 'update reservation set date_annulation = "'.date("Y-m-d H:i:s").'" where id_reservation ='.$_GET["annule"].';';
    $pdo->exec($sql);
    $sql = "update utilisateur set capital = capital + ".($reservation_a_annuler['prix_reservation']*0.9)." where id_utilisateur = ".$donnees_utilisateur['id_utilisateur'].";";
    $pdo->exec($sql);
    echo "<p>Votre réservation a été annulée avec succès.</p>";
}

?>

<h1>Vos réservations</h1>
<?php 
for($i = 0 ; $i < count($reservations) ; $i ++)
{
    if(empty($reservations[$i]['date_annulation']))
    {   
        ?>
        <div>
        <h3>
            <a href="annonce.php/id=<?php echo $reservations[$i]['id_annonce_reservee']?>">
            <?php echo $reservations[$i]["titre"];?>
            </a>
        </h3>
        <p><a href="conversation.php?id=<?php echo $reservations[$i]['id_publicateur'];?>">Envoyer un message à <?php echo $reservations[$i]['prenom'] ;?></a></p>
        <p><a href="?annule=<?php echo $reservations[$i]['id_reservation'] ;?>" onclick="return confirm(<?php echo 'Êtes vous sûr'.$conjugaison.'?'; ?>)">Annuler la réservation</a></p>
        <p><a href="membre.php?id=<?php echo $reservations[$i]['id_publicateur'];?>">Voir le profil de <?php echo $reservations[$i]['prenom'] ;?></a></p>
        </div> 
        <?php 
    }
    else
    {
        ?>
        <div>
        <h3>
            <a href="annonce.php?id=<?php echo $reservations[$i]['id_annonce_reservee']?>">
            <?php echo $reservations[$i]["titre"];?>
            </a>
            </h3>
            <p>Cette réservation a été annulée.</p>
        </div>


        <?php
    } 
}


?>


<?php include("inc/footer.php");?>