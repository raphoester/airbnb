<?php include("inc/header.php");?>

<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}

$annonces = $pdo->query("SELECT * FROM annonce WHERE id_publicateur =".$donnees_utilisateur["id_utilisateur"]." ;");
$annonces = $annonces->fetchAll();
for ($i = 0 ; $i<count($annonces); $i++)
{
    if($annonces[$i]["id_annonce"] == $_GET["id"])
    {
        $annonce_a_modifier = $annonces[$i];
    }
}
if(empty($annonce_a_modifier))
{
    var_dump($_GET);
    // header("location : 404.php");
}



if(!empty($_POST))
{
    if(empty($_POST["titre"]))
    {
        $_POST["titre"] = $annonce_a_modifier["titre"];
    }
    
    if(empty($_POST["description"]))
    {
        $_POST["description"] = $annonce_a_modifier["description"];
    }

    if(empty($_POST["places"]))
    {
        $_POST["places"] = $annonce_a_modifier["locataires_max"];
    }

    if(empty($_POST["ville"]))
    {
        $_POST["ville"] = $annonce_a_modifier["ville"];
    }

    if(empty($_POST["prix"]))
    {
        $_POST["prix"] = $annonce_a_modifier["prix"];
    }


    

    $description = str_replace("'", "\'", $_POST['description']);
    $description = str_replace('"', "\"", $description);

    $titre = str_replace("'", "\'", $_POST['titre']);
    $titre = str_replace('"', "\"", $titre);

    $ville = str_replace("'", "\'", $_POST['ville']);
    $ville = str_replace('"', "\"", $ville);


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
        $sql ="insert into image(nom, id_annonce_image) values ('".mysqli_real_escape_string($mysqli, $file_name)."',".$annonce_a_modifier['id_annonce'].");";
        $pdo->exec($sql);
    }

}

if(!empty($_GET) && !empty($_GET['idsuppr']))
{
    $_GET['idsuppr'] = mysqli_real_escape_string($mysqli, $_GET['idsuppr']);
    $images = $pdo->query("select * from image where id_annonce = ".$annonce_a_modifier['id_annonce'].";")->fetchAll();
    for ($i = 0; $i<count($images); $i++)
    {
        if ($images[$i]["id_image"] == $_GET['idsuppr'])
        {
            $pdo->exec("delete from image where id_image = ".$_GET['idsuppr'].";");
        }
    } 
}

?>
<div>
    <div>
        <h1>Modifier l'annonce</h1>
    </div>
    <div>
        <form action="" method = "POST" enctype="multipart/form-data">
        <div class = "field">
            <label for="titre">Titre de l'annonce</label><br>
            <input type="text" name="titre" id="titre" placeholder = "<?php echo $annonce_a_modifier["titre"];?>">
        </div>
        <div class="field">
            <label for="desc">Description</label><br>
            <textarea name="description" id="desc" cols="30" rows="5" placeholder = "<?php echo $annonce_a_modifier["description"];?>"></textarea>
        </div>
        <div class="field">
            <label for="prix">Prix par jour et par personne</label><br>
            <input type="number" min="1" step="any" value="" id="prix" name="prix" max= 100000 placeholder = "<?php echo $annonce_a_modifier["prix"];?>">€
        </div>
        
        <div class="field">
            <label for="ville">Ville</label><br>
            <input type="text" id="ville" placeholder="Porto" name="ville" placeholder = "<?php echo $annonce_a_modifier["ville"];?>">
        </div>

        <div class="field">
            <label for="places">Nombre maximal de locataires</label><br>
            <input type="number" min="1" id="places" name="places" max = 150 placeholder = "<?php echo $annonce_a_modifier["locataires_max"];?>">
        </div>

        <div class="field">
            <?php 
                $sql = "select * from image where id_annonce_image = ".$annonce_a_modifier['id_annonce'].";";
                $liste_images = $pdo->query($sql)->fetchAll();

                for ($i = 0; $i<count($liste_images); $i++)
                {
                ?>
                    <img style = "width : 200px; height : 150px;"src="<?php echo $liste_images[$i]['nom'];?>" id = 'image' alt="image-annonce"> 
                    <label for="image"><a href="?id=<?php echo $annonce_a_modifier['id_annonce'];?>&idsuppr=<?php echo $liste_images[$i]['id_image'];?>">❌</a></label>   
                <?php
                }
                
            ?>

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