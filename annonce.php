<?php include("inc/header.php");?>

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
    ?>


<div>
    <div>
        <div>
            <h1><?php echo $annonce['titre'];?></h1>
        </div>
        <div>
            <h5>Propriétaire : <a href="membre.php?id=<?php echo $loueur["id_utilisateur"]?>"><?php echo $loueur['prenom']?></a></h5>
        </div>
        <div>
            <label for="description_annonce"></label>
        </div>
        <div>  
            <p id=description_annonce><?php echo $annonce["description"];?></p>
        </div>
        
    </div>



</div>





<?php
}
?>

<?php include("inc/footer.php");?>
