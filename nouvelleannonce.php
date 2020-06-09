<?php include("inc/header.php");?>


<?php 
if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}
else if(!empty($_POST))
{
    $description = str_replace("'", "\'", $_POST['description']);
    $description = str_replace('"', "\"", $description);

    $titre = str_replace("'", "\'", $_POST['titre']);
    $titre = str_replace('"', "\"", $titre);

    $ville = str_replace("'", "\'", $_POST['ville']);
    $ville = str_replace('"', "\"", $ville);


    var_dump($_FILES);

    $nom = $_FILES["img"]["name"];
    $temp = $_FILES["img"]["tmp_name"];
    $dossier = "img/" .$donnees_utilisateur['id_utilisateur'].$nom.time();
    move_uploaded_file($temp, $dossier);

    $sql = "INSERT INTO annonce (titre, description, ville, prix, locataires_max, id_utilisateur) VALUES('".$titre."','".$description."','".$ville."',".$_POST['prix'].",".$_POST['places'].",".$donnees_utilisateur["id_utilisateur"].");";
    $pdo->exec($sql);
    $sql = "select id_annonce from annonce where id_utilisateur =".$donnees_utilisateur['id_utilisateur']." and titre ='".$titre."';)";
    $annonce = $pdo->query($sql)->fetch();
    var_dump($annonce);
    $sql ="insert into image(nom, id_annonce) values ('".$dossier."',".$annonce['id_annonce'].");";
    $pdo->exec($sql);
}


?>


<div>
    <div>
        <h1>Créer une annonce</h1>
    </div>
    <div>
        <form action="" method = "post" enctype="multipart/form-data">
        <div class = "field">
            <label for="titre">Titre de l'annonce</label>
            <input type="text" name="titre" id="titre" required>
        </div>
        <div class="field">
            <label for="desc">Description</label>
            <textarea name="description" id="desc" cols="30" rows="5" required></textarea>
        </div>
        <div class="field">
            <label for="prix">Prix par jour et par personne</label>
            <input type="number" min="1" step="any" value="" id="prix" name="prix" required>€
        </div>

        <div class="field">
            <label for="ville">Ville</label>
            <input type="text" id="ville" placeholder="Porto" name="ville" required>
        </div>

        <div class="field">
            <label for="places">Nombre maximal de locataires</label>
            <input type="number" min="1" id="places" name="places" max = 150 required>
        </div>

        <div>
            <label for="img">Images</label>
            <input type="file" id="img" name="img">
        </div>

        <div class="field">
            <input type="submit" value = "Valider !">
        </div>

        
        </form>
    </div>
</div>
<?php include("inc/footer.php");?>