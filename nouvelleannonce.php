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
        $sql ="insert into image(nom, id_annonce_image) values ('".mysqli_real_escape_string($mysqli, $file_name)."',".$annonce['id_annonce'].");";
        $pdo->exec($sql);
    }

}




?>

<div class="nvl_annonce">
    <div class="ui placeholder segment">
        <div class="column">
            <h3 class="ui dividing header">Créer une annonce</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="ui form">
                    <div class="field">
                        <label for="titre">Titre de l'annonce</label>
                        <div class="ui input">
                            <input class="test" type="text" name="titre" id="titre" required>
                        </div>
                    </div>
                    <div class="field">
                        <label for="desc">Description</label>
                        <div class="ui left icon input">
                            <textarea class="test" size="50" name="description" id="desc" cols="30" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <label for="prix">Prix par jour et par personne</label>
                        <div class="ui left icon input">
                            <input class="test" size="50" type="number" min="1" step="any" value="" id="prix" name="prix" required>
                            <i class="euro icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="ville">Ville</label>
                        <div class="ui left icon input">
                            <input type="text" id="ville" placeholder="Porto" name="ville" required>
                            <i class="at icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="places">Nombre maximal de locataires</label>
                        <div class="ui left icon input">
                            <input class="test" type="number" min="1" id="places" name="places" max = 150 required>
                            <i class="bed icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="img">Images</label>
                        <div class="ui left icon input">
                            <input type="file" id="img" name="img[]" multiple>
                            <i class="images outline icon"></i>
                        </div>
                    </div>
                    <input class="ui blue submit button" type="submit" value="Valider !" name="valider" id="validation"></input>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("inc/footer.php");?>