<?php include("inc/data.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/annonce.css">
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


</html>

<?php
if (empty($_GET["id"]))
{
    header("location : 404.php");
    exit();
}
else
{
    $sql = "select * from annonce where id_annonce =". $_GET['id'].";";
    $pdostatementDA = $pdo->query($sql);
    $annonce = ($pdostatementDA->fetch());

    $sql = "select * from utilisateur where id_utilisateur =".$annonce["id_utilisateur"].";";
    $pdostatementDV = $pdo->query($sql);
    $loueur = $pdostatementDV->fetch();

    $sql = "SELECT * FROM image WHERE id_annonce = ". $annonce['id_annonce'] . ";" ;
    $image = ($pdo -> query($sql));      
    $image = $image -> fetchAll();
    ?>

<div class="container">
    <div>
        <h1><?php echo $annonce['titre'];?></h1>
    </div>
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?php echo $image[0]['nom'];?>" class="d-block w-100" alt="...">
        </div>
        <?php 
          for ($i = 1; $i<count($image); $i++)
          {?>
        <div class="carousel-item">
          <img src="<?php echo $image[$i]['nom'];?>" class="d-block w-100" alt="...">
        </div>
          <?php } ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>    

<div class="ui clearing segment">
    <div>
        <h4 class="pdp">Propriétaire : <a href="membre.php?id=<?php echo $loueur["id_utilisateur"]?>"><?php echo $loueur['prenom']?></h4>
        <img class="pdp" src="img/pdp.jpg"></a>
        <h4>Nombre maximum d'occupants : <?php echo $annonce["locataires_max"];?></h4>
        <h4>Prix par personne et par nuitée : <?php echo $annonce["prix"];?> €</h4>
    </div>
    <div class="ui grey inverted segment"></div>
    <div class="description">
      <h4 for="description_annonce">Description :</h4>
      <h4 id=description_annonce><?php echo $annonce["description"];?></h4>
    </div>
    <div class="ui right floated segment">
      Réserver
    </div>
</div>


</div>


<?php
}
?>

<script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"
    ></script>

<?php include("inc/footer.php");?>