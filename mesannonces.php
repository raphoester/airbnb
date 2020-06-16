<?php include("inc/data.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/mesannonces.css">
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


if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}

if (!empty($_GET["idsuppr"]))
{
    $pdo->exec("delete from image where id_annonce_image = ".$_GET["idsuppr"].";");
    $pdo->exec("delete from reservation where id_annonce_reservee = ".$_GET['idsuppr'].";");
    $pdo->exec("delete from annonce where id_annonce = ".$_GET["idsuppr"].";");
}

$annonces = $pdo->query("SELECT DISTINCT * FROM annonce left join image on image.id_annonce_image = annonce.id_annonce WHERE annonce.id_publicateur =".$donnees_utilisateur["id_utilisateur"]." GROUP BY annonce.id_annonce ORDER BY annonce.id_annonce;");

$mes_annonces = $annonces->fetchAll();

?>

<div class="annonce">
        <h1>
            Toutes vos annonces    :
        </h1>
</div>
<div class="row d-flex justify-content-center">
    <?php
      for($i=0; $i<count($mes_annonces); $i++)
      {?>
    <div class="d-inline-block">
      <div class="card-group">
        <div class="card">
          <img src="<?php echo $mes_annonces[$i]['nom']?>" class="card-img-top">
          <div class="card-body">
            <a class="titre_annonce" href="annonce.php?id=<?php echo $mes_annonces[$i]['id_annonce'];?>"><h3><?php echo $mes_annonces[$i]["titre"]?></h3></a>
            <div class="button">
              <a href="?idsuppr=<?php echo $mes_annonces[$i]['id_annonce']?>"><button type="button" class="btn btn-default btn-sm">Supprimer</button></a>
              <a href="modifierannonce.php?id=<?php echo $mes_annonces[$i]['id_annonce']?>"><button type="button" class="btn btn-primary btn-sm">Modifier</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
</div>

<?php include("inc/footer.php");?>