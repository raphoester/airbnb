<?php include("inc/data.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/message.css">
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

if (!empty($_POST) && !empty($_POST['bloque']) && $_POST['bloque'] == 'on')
{
    $sql = "insert into blocage (id_bloque,id_bloqueur, vraifaux) values(".$_POST['idbloque'].", ".$donnees_utilisateur['id_utilisateur'].", True);";
    $pdo->exec($sql);  
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
<div class="container my-5">


<!--Section: Content-->
<section class="dark-grey-text">

  <!-- Section heading -->
  <h3 class="text-center font-weight-bold mb-4 pb-2">Vos conversations :</h3>

        
        
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
    
    <!--First row-->
    <div class="row">

      <!--First column-->
      <div class="col-md-6 mb-4">

        <!-- Card -->
        <a href="conversation.php?id=<?php echo $correspondant[0]["id_utilisateur"];?>" class="card hoverable">
          
          <!-- Card content -->
          <div class="card-body">

          	<div class="media">
                <img src="<?php echo $correspondant[0]["image_profil"];?>" class="pdp">
              <div class="media-body">
                <h5 class="dark-grey-text mb-3"><?php echo $correspondant[0]["prenom"]; ?></h5>
                <p class="font-weight-light text-muted mb-0"><strong>Message : </strong><?php echo $message_a_afficher?></p>
              </div>
            </div>     
            
          </div>

        </a>
      </div>
    </div>
    <?php
        }
    }
    ?>
</section>
  
  




<?php include('inc/footer.php');?>