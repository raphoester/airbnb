<?php include("inc/header.php");?>
<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}

if(!empty($_GET["id"]))
{
    $infos = $pdo->query("select * from utilisateur where id_utilisateur = ". $_GET['id'].";")->fetch();
}

?>
<section>
    <div>
        <div>
            <h1>Profil de <?php echo $infos["prenom"];?></h1>
        </div>
        <div>
            <img class = "pdp" src="<?php echo $infos["image_profil"];?>" alt="" >
        </div>
        <div>
            <h5>Statut : <?php echo $infos["statut"];?></h5>
        </div>
        <a class = "ui big button" href="conversation.php?id=<?php echo $infos['id_utilisateur'];?>">Envoyer un message à <?php echo $infos["prenom"];?></a>
    </div>

</section>
<?php include("inc/footer.php");?>