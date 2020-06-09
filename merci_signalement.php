<?php include('inc/header.php');?>
<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();  
}

if(!empty($_POST["id_message"]))
{
    $_POST['description'] = str_replace("'", "\'", $_POST['description']);
    $_POST['motif'] = str_replace('"', "\"", $_POST['motif']);

    $sql = "insert into signalement (description, motif, id_message_signale) values ('". $_POST['description']."', '". $_POST['motif']."', ". $_POST['id_message'].");";
    $pdo->exec($sql);

    $sql = "select * from message where id_message = ". $_POST['id_message'].";";
    $message = $pdo->query($sql)->fetch();

    $sql = "select * from utilisateur where id_utilisateur = ". $message['id_expediteur'].";";
    $auteur_message = $pdo->query($sql)->fetch();

    ?>
    <section>
    <div>
        <div>
            <h1>Merci pour votre aide !</h1>
            <h4>Notre équipe de modération va examiner votre signalement. </h4> 
        </div>
        <form action="messages.php" method = "POST">
            <label for="bloque">Bloquer <?php echo $auteur_message['prenom']?> ?</label>
            <input type="checkbox" id="bloque" name = 'bloque'>
            <br>
            <input type="number" name = "idbloque" value = "<?php echo $auteur_message['id_utilisateur'];?>" style = "display:none;">
            <input type = "submit" id = "bloque" class = "ui big button" href="messages.php" value= "Retourner aux messages">
        </form>
        
    </div>
    </section>
    <?php
}
else
{?>
    <section>
    <div>
        <div>
            <h1>Le signalement a échoué.</h1>
        </div>
        <a class = "ui big button" href="messages.php">Retourner aux messages</a>
    </div>
    </section>
   <?php 
}

?>





<?php include('inc/footer.php');?>