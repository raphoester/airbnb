<?php include('inc/header.php');?>
<?php
if (empty($_SESSION["login"]))
{
    header("location : connexion.php");
}
?>
<section>
<div>
<h1>
<?php 
$date1 = new DateTime($_GET["da"]);
$date2 = new DateTime($_GET["dd"]);

$intervale = $date1->diff($date2);
$duree_sejour = $intervale->format('%a');


$annonce = $pdo->query("select * from annonce where id_annonce = ".$_GET['id_annonce'].";")->fetch();
$prix = $duree_sejour*$annonce['prix']*$_GET['places'];

$affiche = False;
    $sql = "select * from reservation where id_annonce_reservee =".$_GET['id_annonce'].";";
    $reservations = $pdo->query($sql)->fetchAll();

    for($i = 0; $i<count($reservations); $i++)
    {
 
        if(($_GET['da'] > $reservations[$i]['date_debut'] && $_GET['da'] < $reservations[$i]['date_fin']) || ($_GET['dd'] > $reservations[$i]['date_debut'] && $_GET['dd'] < $reservations[$i]['date_fin'])||($_GET['da'] < $reservations[$i]['date_debut'] && $_GET['dd'] > $reservations[$i]['date_fin']))
        {   
            ?>
            La réservation à cette date n'est pas disponible.
            <?php
            $affiche = True;
        break;
        }
    }
    if($affiche == False)
    {
        if($donnees_utilisateur['capital'] >= $prix)
        {
            ?>
            <h1>La réservation a été effectuée avec succès.</h1>
            <?php
            $sql = "insert into reservation(id_annonce_reservee, id_reservant, date_debut, date_fin, prix_reservation ) values (".$_GET['id_annonce'].",".$donnees_utilisateur['id_utilisateur'].",'".$_GET['da']."','".$_GET['dd']."',".$prix.");"; 
            $pdo->exec($sql);
            $sql = "update utilisateur set capital = capital - ".$prix." where id_utilisateur = ".$donnees_utilisateur['id_utilisateur'].";";
            $pdo->exec($sql);
            $sql = "update utilisateur set capital = capital + ".(0.9*$prix)." where id_utilisateur = ".$annonce['id_publicateur'].";";
        }
        else
        {   ?>
            <h1>Erreur lors de la réservation : vous êtes trop pauvre ! :( </h1>
            <?php
        }
        

    }
?>
</h1>
</div>

</section>
<?php include('inc/footer.php');?>