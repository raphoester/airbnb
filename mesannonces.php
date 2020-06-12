<?php include("inc/header.php");?>




<?php


if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}

if (!empty($_GET["idsuppr"]))
{
    $pdo->exec("delete from annonce where id_annonce = ".$_GET["idsuppr"].";");
}


$annonces = $pdo->query("SELECT * FROM annonce WHERE id_utilisateur =".$donnees_utilisateur["id_utilisateur"]." ;");
$mes_annonces = $annonces->fetchAll();


?>

<section>
    <div>
        <h1>
            Toutes vos annonces    :
        </h1>
    </div>
        <div>
            <?php
            for($i=0; $i<count($mes_annonces); $i++)
            {?>
                <div>
                <a href="annonce.php?id=<?php echo $mes_annonces[$i]['id_annonce'];?>"><h3><?php echo $mes_annonces[$i]["titre"]?></h3></a>
                <a href="?idsuppr=<?php echo $mes_annonces[$i]['id_annonce']?>">Supprimer</a><br>
                <a href="modifierannonce.php?id=<?php echo $mes_annonces[$i]['id_annonce']?>">Modifier</a>
                </div>
            <?php
            }?>
        </div>
</section>

<?php
  for($i=0; $i<count($mes_annonces); $i++)
  {?>
<div class="d-inline-block">
  <div class="card-group">
    <div class="card">
      <img src="<?php echo $image[0]['nom']?>" class="card-img-top">
      <div class="card-body">
        <a class="title" href="annonce.php?id=<?php echo $mes_annonces[$i]['id_annonce'];?>"><h3><?php echo $mes_annonces[$i]["titre"]?></h3></a>
        <h5><small><a href="?idsuppr=<?php echo $mes_annonces[$i]['id_annonce']?>">Supprimer</a></small</h5>
        <h5><small><a href="modifierannonce.php?id=<?php echo $mes_annonces[$i]['id_annonce']?>">Modifier</a></small></h5>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php include("inc/footer.php");?>