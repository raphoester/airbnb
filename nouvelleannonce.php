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

    $sql = "INSERT INTO annonce (titre, description, ville, prix, locataires_max, id_utilisateur) VALUES('".$titre."','".$description."','".$ville."',".$_POST['prix'].",".$_POST['places'].",".$donnees_utilisateur["id_utilisateur"].");";
    $pdo->exec($sql);
    $sql = "select id_annonce from annonce where id_utilisateur =".$donnees_utilisateur['id_utilisateur']." and titre ='".$titre."';)";
    $annonce = $pdo->query($sql)->fetch();




    $erreurs=array();
    $extension=array("jpeg","jpg","png","gif");
    for ($i = 0; $i<count($_FILES["img"]["tmp_name"]) ; $i++)
    {
        $file_name = "img/annonces/".time().$donnees_utilisateur['id_utilisateur'].$_FILES["img"]["name"][$i];
        $file_tmp=$_FILES["img"]["tmp_name"][$i];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
        
        if(in_array($ext,$extension)) 
        {
            move_uploaded_file($_FILES["img"]["tmp_name"][$i],$file_name);            
        }
        else 
        {
            array_push($erreurs,"$file_name");
        }
        $sql ="insert into image(nom, id_annonce) values ('".mysqli_real_escape_string($mysqli, $file_name)."',".$annonce['id_annonce'].");";
        $pdo->exec($sql);
    }

}




?>


<div>
    <div>
        <h1>Créer une annonce</h1>
    </div>
    <div>
        <form action="" method = "post" enctype="multipart/form-data">
        <div class = "field">
            <label for="titre">Titre de l'annonce</label><br>
            <input type="text" name="titre" id="titre" required>
        </div>
        <div class="field">
            <label for="desc">Description</label><br>
            <textarea name="description" id="desc" cols="30" rows="5" required></textarea>
        </div>
        <div class="field">
            <label for="prix">Prix par jour et par personne</label><br>
            <input type="number" min="1" step="any" value="" id="prix" name="prix" required> €
        </div>

        <div class="field">
            <label for="ville">Ville</label><br>
            <input type="text" id="ville" placeholder="Porto" name="ville" required>
        </div>

        <div class="field">
            <label for="places">Nombre maximal de locataires</label><br>
            <input type="number" min="1" id="places" name="places" max = 150 required>
        </div>

        <div>
            <label for="img">Images (formats acceptés : jpeg, jpg, png, gif)</label><br>
            <input type="file" id="img" name="img[]" multiple>
        </div>

        <div class="field">
            <input type="submit" value = "Valider !">
        </div>

        
        </form>
    </div>
</div>
<?php include("inc/footer.php");?>