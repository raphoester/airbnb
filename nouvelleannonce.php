<?php include("inc/data.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/annonce.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script src="semantic/dist/semantic.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

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



    extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$temp) 
    {
        $nom=$_FILES["files"]["name"][$key];
        $temp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($nom,PATHINFO_EXTENSION);

        if(in_array($ext,$extension)) {
            if(!file_exists("img/annonces/".$txtGalleryName."/".$nom)) {
                move_uploaded_file($temp=$_FILES["files"]["tmp_name"][$key],"img/annonces/".$txtGalleryName."/".$nom);
            }
            else {
                $filename=basename($nom,$ext);
                $newFileName=$filename.time().".".$ext;
                move_uploaded_file($temp=$_FILES["files"]["tmp_name"][$key],"img/annonces/".$txtGalleryName."/".$newFileName);
            }
        }
        else {
            array_push($error,"$nom, ");
        }
    }




    $nom = $_FILES["img"]["name"];
    $temp = $_FILES["img"]["tmp_name"];
    $dossier = "img/annonces/" .time().$donnees_utilisateur['id_utilisateur'].$nom;
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

<header>
<div class="shadow-sm p-3 mb-5 bg-white rounded">
    <nav>
        <ul class="nav justify-content-end">
            <a href="index.php"><img class="logo" src="img/logo_airbnb.jpg" alt="logo" href="index.php"></a>

        <?php
        if(empty($_SESSION["login"]))
        {?>

        <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="creercompte.php">Inscription</a>
        </li>
        <?php 
        }
        else if ($_SESSION["login"] == 1)
        {?>

        <li class ="nav-item">
            <p class="nav-link"><?php echo $donnees_utilisateur["capital"];?> €</p>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="nouvelleannonce.php">Poster une annonce</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="compte.php">Espace personnel</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="?dec=True">Déconnexion</a>
        </li>

        <?php } ?>
        </ul>
    </nav>
</div>

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
                            <input type="file" id="img" name="img" multiple>
                            <i class="images outline icon"></i>
                        </div>
                    </div>
                    <input class="ui blue submit button" type="submit" value="Valider !" name="valider" id="validation"></input>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

<?php include("inc/footer.php");?>