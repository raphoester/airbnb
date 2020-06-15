<?php include("inc/header.php");?>




<?php


if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}




if (!empty($_GET["idsuppr"]))
{
    $pdo->exec("delete from image where id_annonce_image = ".$_GET["idsuppr"].";");
    $pdo->exec("delete from annonce where id_annonce = ".$_GET["idsuppr"].";");
}


$annonces = $pdo->query("SELECT DISTINCT * FROM annonce left join image on image.id_annonce_image = annonce.id_annonce WHERE annonce.id_publicateur =".$donnees_utilisateur["id_utilisateur"]." GROUP BY annonce.id_annonce ORDER BY annonce.id_annonce;");

$mes_annonces = $annonces->fetchAll();

?>

<section>
    <div>
        <h1>
            Toutes vos annonces    :
        </h1>
</section>


<?php
  for($i=0; $i<count($mes_annonces); $i++)
  {?>
<div class="d-inline-block">
  <div class="card-group">
    <div class="card">
      <img src="<?php echo $mes_annonces[$i]['nom']?>" class="card-img-top">
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