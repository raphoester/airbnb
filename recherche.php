<?php include("inc/header.php");?>

<?php

if(!empty($_GET))
{?>
    
    <h2>Resultats de la recherche</h2>
    <p><a href="index.php">Rechercher autre chose ?</a></p>
    <?php 
    $annoncesCorrespondantes = $pdo->query("SELECT * FROM annonce WHERE ville ="."'".$_GET['ville']."' AND locataires_max >= "."'".$_GET['places']."' ;");
    $reservationsConflit = $pdo->query("SELECT * from reservation where (date_debut >= "."'".$_GET['dA']."' AND date_debut <= "."'".$_GET['dD']."') OR (date_fin >= "."'".$_GET['dA']."' AND date_fin <= "."'".$_GET['dD']."');");
    $tout = $annoncesCorrespondantes->fetchAll();
    $conflits = $reservationsConflit->fetchAll();




    $i=0;
    for($i=0; $i<count($tout); $i++)
    {
        $afficher = True;
        for($j=0;$j<count($conflits);$j++){
            if($tout[$i]["id_annonce"] == $conflits[$j]["id_annonce"]){
                $afficher = False;
            }
        }
        if ($afficher){?>
            <div>
            <h3><a href="<?php echo 'annonce.php?id='.$tout[$i]["id_annonce"]?>"><?php echo $tout[$i]["titre"]?></a></h3>
              <h5><?php echo $tout[$i]['ville']?></h5>
            </div>
        <?php
        }
        else 
        {
            ?>
            </div>
            <h3><a href="<?php echo 'annonce.php?id='.$tout[$i]["id_annonce"]?>"><?php echo $tout[$i]["titre"]?></a></h3>
            <h5><?php echo $tout[$i]['ville']?></h5>
            <h4>RÉSERVÉ !!!!!!!!!!!! fallait aller plus vite mon pote<br><h4>
            </div>
            <?php
        }

    }  
} 
?>

<?php include("inc/footer.php");?>