<?php include("inc/header.php");?>

<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}

var_dump($_POST);

$annonces = $pdo->query("SELECT * FROM annonce WHERE id_utilisateur =".$donnees_utilisateur["id_utilisateur"]." ;");
$annonces = $annonces->fetchAll();
for ($i = 0 ; $i<count($annonces); $i++)
{
    if($annonces[$i]["id_annonce"] == $_GET["id"])
    {

        $annonce_a_modifier = $annonces[$i];
    }
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


    var_dump($annonce_a_modifier);

//suppression des images 1-2-3
    if(!empty($_POST["sprimg"]))
    {
        if($_POST["sprimg"] !=NULL && $annonce_a_modifier["image"] != NULL && $annonce_a_modifier["image"]!= "")
        {
            unlink($annonce_a_modifier['image']);
            $pdo->exec("UPDATE annonce SET image = \"\";");
        }
    }
    if(!empty($_POST["sprimg2"]))
    {
        if($_POST["sprimg2"] !=NULL && $annonce_a_modifier["image2"] != NULL && $annonce_a_modifier["image2"]!= "")
        {
            unlink($annonce_a_modifier['image2']);
            $pdo->exec("UPDATE annonce SET image2 = \"\";");
        }
    }

    if(!empty($_POST["sprimg3"]))
    {
        if($_POST["sprimg3"] !=NULL && $annonce_a_modifier["image3"] != NULL && $annonce_a_modifier["image3"]!= "")
        {
            unlink($annonce_a_modifier['image3']);
            $pdo->exec("UPDATE annonce SET image3 = \"\";");
        }
    }

    $description = str_replace("'", "\'", $_POST['description']);
    $description = str_replace('"', "\"", $description);

    $titre = str_replace("'", "\'", $_POST['titre']);
    $titre = str_replace('"', "\"", $titre);

    $ville = str_replace("'", "\'", $_POST['ville']);
    $ville = str_replace('"', "\"", $ville);
    
    $folder = NULL;
    if (!empty($_FILES))
    {
        $filename = $_FILES["img"]["name"];
        $tempname = $_FILES["img"]["tmp_name"];
        $folder = "img/" .$filename;
        move_uploaded_file($tempname, $folder);
    }


    if($annonce_a_modifier["image"] == NULL)
    {
        $sql = "UPDATE annonce SET titre='".$titre."', description = '".$description."', ville = '".$ville."', prix = ".$_POST['prix'].", locataires_max = ".$_POST['places'].", image = '".$folder."' WHERE id_annonce = ".$annonce_a_modifier['id_annonce'].";";
    }
    else if ($annonce_a_modifier["image2"] == NULL)
    {
        $sql = "UPDATE annonce SET titre='".$titre."', description = '".$description."', ville = '".$ville."', prix = ".$_POST['prix'].", locataires_max = ".$_POST['places'].", image2 = '".$folder."' WHERE id_annonce = ".$annonce_a_modifier['id_annonce'].";";
    }
    else if ($annonce_a_modifier["image3"] == NULL)
    {
        $sql = "UPDATE annonce SET titre='".$titre."', description = '".$description."', ville = '".$ville."', prix = ".$_POST['prix'].", locataires_max = ".$_POST['places'].", image3 = '".$folder."' WHERE id_annonce = ".$annonce_a_modifier['id_annonce'].";";
    }


    
    $result = $pdo->exec($sql);

}

?>
<div>
    <div>
        <h1>Modifier l'annonce</h1>
    </div>
    <div>
        <form action="" method = "POST" enctype="multipart/form-data">
        <div class = "field">
            <label for="titre">Titre de l'annonce</label>
            <input type="text" name="titre" id="titre" placeholder = "<?php echo $annonce_a_modifier["titre"];?>">
        </div>
        <div class="field">
            <label for="desc">Description</label>
            <textarea name="description" id="desc" cols="30" rows="5" placeholder = "<?php echo $annonce_a_modifier["description"];?>"></textarea>
        </div>
        <div class="field">
            <label for="prix">Prix par jour et par personne</label>
            <input type="number" min="1" step="any" value="" id="prix" name="prix" max= 100000 placeholder = "<?php echo $annonce_a_modifier["prix"];?>">€
        </div>
        
        <div class="field">
            <label for="ville">Ville</label>
            <input type="text" id="ville" placeholder="Porto" name="ville" placeholder = "<?php echo $annonce_a_modifier["ville"];?>">
        </div>

        <div class="field">
            <label for="places">Nombre maximal de locataires</label>
            <input type="number" min="1" id="places" name="places" max = 150 placeholder = "<?php echo $annonce_a_modifier["locataires_max"];?>">
        </div>

        <div class="field">
            <label for="img">Images</label>
            </div>
                <?php 
               //affichage des images
                    if($annonce_a_modifier["image"]!=NULL)
                    {
                        ?>
                            <div>
                                <img width="300px" height="200px" src="<?php echo $annonce_a_modifier['image'].time()?>">
                            </div>
                        <?php
                        
                    }                    
                    
                    if($annonce_a_modifier["image2"]!=NULL)
                    {
                        ?>
                            <div>
                                <img width="300px" height="200px" src="<?php echo $annonce_a_modifier['image2'].time()?>">
                            </div>
                        <?php
                        
                    }
                    
                    if($annonce_a_modifier["image3"]!=NULL)
                    {
                        ?>
                            <div>
                                <img width="300px" height="200px" src="<?php echo $annonce_a_modifier['image3'].time()?>">
                            </div>
                        <?php
                        
                    }  
                    //ajouter une image
                    if (!($annonce_a_modifier["image"]!=NULL && $annonce_a_modifier["image2"]!=NULL && $annonce_a_modifier["image3"]!=NULL))
                    {
                        ?>
                        <div>
                        <h4>Ajouter une image (maximum : 3)</h4>
                        <input type="file" id="img" name="img">
                        </div> 
                    <?php
                    }

                    if(($annonce_a_modifier["image"]!=NULL || $annonce_a_modifier["image2"]!=NULL || $annonce_a_modifier["image3"]!=NULL))
                    {
                        if($annonce_a_modifier["image"]!=NULL)
                        {
                        ?>
                        <div>
                        <label for="supprImage1">Supprimer l'image 1</label>
                        <input type="checkbox" id="supprImage1" name="sprimg1">
                        </div>                        
                        <?php
                        }

                        if($annonce_a_modifier["image2"]!=NULL)
                        {
                        ?>
                        <div>
                        <label for="supprImage2">Supprimer l'image 2</label>
                        <input type="checkbox" id="supprImage2" name="sprimg2">
                        </div>                        
                        <?php
                        }

                        if($annonce_a_modifier["image3"]!=NULL)
                        {
                        ?>
                        <div>
                        <label for="supprImage3">Supprimer l'image 3</label>
                        <input type="checkbox" id="supprImage3" name="sprimg3">
                        </div>                        
                        <?php
                        }
                    }
                
                ?>

        </div>

        <div class="field">
            <input type="submit" value = "Valider !">
        </div>

        
        </form>
    </div>
</div>

<?php include("inc/footer.php");?>