<?php include("inc/header.php");?>

<?php

if(!empty($_GET))
{
    $date1 = new DateTime($_GET["dA"]);
    $date2 = new DateTime($_GET["dD"]);

    $intervale = $date1->diff($date2);
    $dureeSejour = $intervale->format('%a');
    ?>
<div class="main">
    <div class="gauche">
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

        $sql = "select distinct * from annonce a 
        left join reservation r 
        on r.id_annonce_reservee = a.id_annonce
        where   
        ((r.date_debut < '".$_GET['dA']."' or r.date_debut > '".$_GET['dD']."') 
        and (r.date_fin < '".$_GET['dA']."' or r.date_fin > '".$_GET['dD']."') or r.id_reservation is NULL)
        and (a.prix > ".$_GET['prixMin'] ." and a.prix < ".$_GET['prixMax'].") 
        and (a.ville = '".$_GET['ville']."')
        and (locataires_max >= ".$_GET['places'].")
        group by a.id_annonce 
        ;";

        $annonces = $pdo->query($sql)->fetchAll();

        for($i=0; $i<count($annonces); $i++)
        {
            $sql = "SELECT * FROM image WHERE id_annonce_image = ". $annonces[$i]['id_annonce'] . ";" ;
            $image = ($pdo -> query($sql));      
            $image = $image -> fetchAll();
            $afficher = True;

            $prixSejour = $annonces[$i]['prix']*$dureeSejour*$_GET['places'];
            ?>
            <div class="ui unstackable items">
                <div class="item">
                    <div class="big-image">
                        <img src="<?php echo $image[0]['nom']?>" height="200px" width="300px">
                    </div>
                    <div class="content">
                        <a class="header" <a  class="header" href="annonce.php?id=<?php echo $annonces[$i]['id_annonce'];?>&da=<?php echo $_GET['dA'];?>&dd=<?php echo $_GET['dD'];?>&places=<?php echo $_GET['places'];?>"><?php echo $annonces[$i]["titre"];?></a>
                        <div class="description">
                            <p><i class="bed icon"></i><?php echo $annonces[$i]["locataires_max"]?> personnes max</p>
                        </div>
                        <div class="extra">
                            <h5><?php echo $prixSejour;?> € </h5>
                        </div>
                    </div>
                </div>
                <div class="ui grey inverted segment">
                </div>
            </div>
        <?php }
        }
        ?>
    </div>
    <div class="droite">
        <div class="position-fixed">
            <iframe src="https://maps.google.com/maps?q=paris&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                    style="border:0" allowfullscreen class="map"></iframe>
        </div>
    </div>
</div>

<?php include("inc/footer.php");?>