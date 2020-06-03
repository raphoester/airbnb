<?php include("inc/header.php");?>

<?php

if(!empty($_GET))
{?>
    <h2 class="mb-5">Resultats de la recherche</h2>
    <p><a href="index.php">Rechercher autre chose ?</a></p>
    <?php 

    $resultat = $pdo->query("SELECT * FROM annonce WHERE ville ="."'".$_GET['ville']."';");
    echo "SELECT * FROM annonce WHERE ville ="."'".$_GET['ville']."';";
    while($tab_annonces = $resultat->fetch(PDO::FETCH_OBJ)) {
      
    ?>
    <div>
        <h3><a href="<?php echo 'annonce.php?id='.$tab_annonces->id_annonce?>"><?php echo $tab_annonces->titre?></a></h3>
        <h5><?php echo $tab_annonces->ville?></h5>
    </div>
        
    <?php
    }

}
?>
<?php include("inc/footer.php");?>