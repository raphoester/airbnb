<?php include("inc/header.php");?>

<?php

if(!empty($_GET))
{
    $date1 = new DateTime($_GET["dA"]);
    $date2 = new DateTime($_GET["dD"]);

    $intervale = $date1->diff($date2);
    $dureeSejour = $intervale->format('%a');
    ?>

    <div class = "resultat">
        <h2>Resultats de la recherche</h2>
        <h5>Tarifs pour <?php echo $_GET["places"]?> personnes pendant <?php echo $dureeSejour?> jours.</h5>
        <p><a href="index.php">Rechercher autre chose ?</a></p>
    </div>
        
    <?php 

    $ville = str_replace("'", "\'", $_GET['ville']);
    $ville = str_replace('"', "\"", $ville);

    if ($_GET["prixMin"] == "")
    {
        $_GET["prixMin"] = 0;
    }

    if ($_GET["prixMax"] == "")
    {
        $_GET["prixMax"] = 100000;
    }

    $sql = "SELECT * FROM annonce WHERE ville ="."'".$ville."' AND locataires_max >= ".$_GET['places']." AND prix >= ".$_GET['prixMin']." AND prix <= ".$_GET["prixMax"].";";
    $annoncesCorrespondantes = $pdo->query($sql);

    $reservationsConflit = $pdo->query("SELECT * from reservation where (date_debut >= "."'".$_GET['dA']."' AND date_debut <= "."'".$_GET['dD']."') OR (date_fin >= "."'".$_GET['dA']."' AND date_fin <= "."'".$_GET['dD']."');");
    
    $tout = $annoncesCorrespondantes->fetchAll();
    $conflits = $reservationsConflit->fetchAll();





    

    $i=0;
    for($i=0; $i<count($tout); $i++)
    {
        $sql = "SELECT * FROM image WHERE id_annonce = ". $tout[$i]['id_annonce'] . ";" ;
        $image = ($pdo -> query($sql));      
        $image = $image -> fetchAll();
        $afficher = True;
        for($j=0;$j<count($conflits);$j++){
            if($tout[$i]["id_annonce"] == $conflits[$j]["id_annonce"]){
                $afficher = False;
            }
        }

        $prixSejour = $tout[$i]['prix']*$dureeSejour*$_GET['places'];

        if ($afficher){?>



            <div class="ui unstackable items">
                <div class="item">
                    <div class="big-image">
                    <img src="<?php echo $image[0]['nom']?>" height="200px" width="300px">
                    </div>
                    <div class="content">
                    <a class="header" href="<?php echo 'annonce.php?id='.$tout[$i]["id_annonce"]?>"><?php echo $tout[$i]["titre"]?></a>
                    <div class="description">
                        <p><?php echo $tout[$i]["description"]?></p>
                    </div>
                    <div class="extra">
                        <h5><?php echo $prixSejour;?> € / nuit</h5>
                    </div>
                    </div>
                </div>
                <div class="ui grey inverted segment"></div>
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

