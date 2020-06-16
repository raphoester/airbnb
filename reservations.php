<?php include("inc/data.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/reservation.css">
    <link href='https://css.gg/css' rel='stylesheet'>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
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

<div class="main">
    <div class="reservation">
        <h1 class="annonce"> Toutes vos réservations : </h1>
        <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th class="th-sm">Annonce
                </th>
                <th class="th-sm">Propriétaire
                </th>
                <th class="th-sm">Date d'arrivée
                </th>
                <th class="th-sm">Date de départ
                </th>
                <th class="th-sm">Prix
                </th>
                <th class="th-sm">Annuler
                </th>
                </tr>
            </thead>
            <?php 
            for($i = 0 ; $i < count($reservations) ; $i ++)
            {
                if(empty($reservations[$i]['date_annulation']))
                {   
                ?>
            <tbody>
                <tr>
                <td><a href="annonce.php?id=<?php echo $reservations[$i]['id_annonce_reservee']?>"><?php echo $reservations[$i]["titre"]?></a></td>
                <td><a href="membre.php?id=<?php echo $reservations[$i]['id_publicateur'];?>"><?php echo $reservations[$i]['prenom'] ?></a></td>
                <td><?php echo $reservations[$i]["date_debut"]?></td>
                <td><?php echo $reservations[$i]["date_fin"]?></td>
                <td><?php echo $reservations[$i]["prix_reservation"]?>€</td>
                <td><a href="?annule=<?php echo $reservations[$i]['id_reservation'] ?>" onclick="return confirm(<?php echo 'Êtes vous sûr'.$conjugaison.'?' ?>)">Annuler la réservation</td>
                </tr>
            </tbody>
            <?php 
            }
        }
            ?>
        </table>
    </div>
            <div class="annulation">
                <h1 class="annonce"> Vos réservations annulées :</h1>
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th class="th-sm">Annonce
                        </th>
                        <th class="th-sm">Propriétaire
                        </th>
                        <th class="th-sm">Date d'arrivée
                        </th>
                        <th class="th-sm">Date de départ
                        </th>
                        <th class="th-sm">Prix
                        </th>
                        <th class="th-sm">Date d'annulation
                        </th>
                        </tr>
                    </thead>
                    <?php 
                    for($i = 0 ; $i < count($reservations) ; $i ++)
                    {
                    if(!empty($reservations[$i]['date_annulation']))
                    {
                    ?>
                    <tbody>
                        <tr>
                        <td><a href="annonce.php?id=<?php echo $reservations[$i]['id_annonce_reservee']?>"><?php echo $reservations[$i]["titre"]?></a></td>
                        <td><a href="membre.php?id=<?php echo $reservations[$i]['id_publicateur'];?>"><?php echo $reservations[$i]['prenom'] ?></a></td>
                        <td><?php echo $reservations[$i]["date_debut"]?></td>
                        <td><?php echo $reservations[$i]["date_fin"]?></td>
                        <td><?php echo $reservations[$i]["prix_reservation"]?>€</td>
                        <td><?php echo $reservations[$i]["date_annulation"]?></td>
                        </tr>
                    </tbody>
                <?php 
                } 
                }
                ?>
                 </table>
            </div>
</div>


<?php include("inc/footer.php");?>