<?php include('inc/header.php');?>



<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();  
}

if (empty($_GET["id"]))
{
    header("Location : 404.php");
    exit();
}

$sql = "select * from message where id_message = ". $_GET['id'].";";
$message = $pdo->query($sql)->fetch();

if (!empty($message))
{
    $sql = "select * from utilisateur where id_utilisateur = ".$message['id_expediteur'].";";
    $auteur = $pdo->query($sql)->fetch();
        
    if ($message['id_expediteur'] == $donnees_utilisateur['id_utilisateur'])
    {
        echo "<h1>Vous ne pouvez pas signaler votre propre message ! </h1>";
    }

    else if ($message['id_destinataire'] == $donnees_utilisateur['id_utilisateur'])
    {?>
    <section>
        <div>
            <h1>Signaler un message</h1>    
            <div>
                <h2>Informations sur le message : </h2>
                <h4>Contenu :</h4>
                <p>"<?php echo $message['contenu'];?>"</p>
                <h4>posté le : </h4>
                <p><?php echo $message['date_envoi']?></p>
                <h4>par :</h4> 
                <p><?php echo $auteur ["prenom"];?></p>
            </div>
            <div>
            <h2>Donnez nous plus de détails :</h2>
            <form action="merci_signalement.php" method = "POST">
                <input type="number" name="id_message" style ="display:none;" value = "<?php echo $message['id_message'];?>">
                <label for="selection_motif">Motif de signalement :</label><br>
                <select name="motif" id="selection_motif">
                    <option value="insulte">Insultant ou haineux</option>
                    <option value="menace">Menaces</option>
                    <option value="harcelement">Harcèlement</option>
                    <option value="pub">Publicité personnelle</option>
                    <option value="illegal">Activité illégale</option>
                    <option value="autre">Autre</option>
                </select><br>
                <label for="description">Expliquez-nous ce qui s'est passé...</label><br>
                <textarea name="description" id="description" cols="60" rows="10"></textarea><br>
                <input type="submit" value="Envoyer le rapport">
            </form>

            </div>
        </div>
    </section>


    <?php
    }
    else
    {
        echo "<h1>Vous ne pouvez pas signaler ce message</h1>";
    }
}
else
{
    echo "<h1>Ce message n'existe pas </h1>";
}
?>




<?php include('inc/footer.php');?>