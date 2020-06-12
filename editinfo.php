<?php include("inc/header.php");?>


<?php 

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}


if(!empty($_FILES))
{
    $erreurs=array();
    $extensions=array("jpeg","jpg","png","gif");

    
    $file_name = "img/profils/".time().$donnees_utilisateur['id_utilisateur'].$_FILES["img"]["name"];
    $file_tmp=$_FILES["img"]["tmp_name"];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
    if(in_array(strtolower($ext),$extensions)) 
    {
        
        move_uploaded_file($_FILES["img"]["tmp_name"], $file_name);            
    }
    else 
    {
        array_push($erreurs,"$file_name");
    }
    $file_name = (mysqli_real_escape_string($mysqli, $file_name));
    $sql ="update utilisateur set image_profil = '".$file_name."' where id_utilisateur = ".$donnees_utilisateur['id_utilisateur'].";";
    echo $sql;
    $pdo->exec($sql);

}


if (!empty($_POST))
{
    if(!empty($_POST["nom"]))
    {
        $_POST["nom"]= str_replace("'", "\'", $_POST['nom']);
        $_POST["nom"] = str_replace('"', "\"", $_POST["nom"]);

        $sql = "update utilisateur set nom ='". $_POST['nom']."'where id_utilisateur =".$donnees_utilisateur['id_utilisateur'].";";
        $pdo->exec($sql); 
    }
    
    if(!empty($_POST["prenom"]))
    {
        $_POST["prenom"]= str_replace("'", "\'", $_POST['prenom']);
        $_POST["prenom"] = str_replace('"', "\"", $_POST["prenom"]);

        $sql = "update utilisateur set prenom ='". $_POST['prenom']."'where id_utilisateur =".$donnees_utilisateur['id_utilisateur'].";";
        $pdo->exec($sql); 
    }
    
    if(!empty($_POST["email"]))
    {
        $_POST["email"]= str_replace("'", "\'", $_POST['email']);
        $_POST["email"] = str_replace('"', "\"", $_POST["email"]);

        $sql = "update utilisateur set email ='". $_POST['email']."'where id_utilisateur =".$donnees_utilisateur['id_utilisateur'].";";
        $pdo->exec($sql); 
    }

    if(!empty($_POST["ancienMDP"]) && !empty($_POST["nouveauMDP"]) && !empty($_POST["nouveauMDPConf"]) && (md5($_POST["ancienMDP"]) == $donnees_utilisateur["mot_de_passe"]) && (md5($_POST["nouveauMDP"]) == md5($_POST["nouveauMDPConf"])))
    {
        echo $_POST["nouveauMDP"];
        echo md5($_POST["nouveauMDP"]);
        $sql = "update utilisateur set mot_de_passe ='". md5($_POST['nouveauMDP'])."'where id_utilisateur =".$donnees_utilisateur['id_utilisateur'].";";
    }
    $donnees_utilisateur = $pdo->query("select * from utilisateur where id_utilisateur = ".$donnees_utilisateur['id_utilisateur'].";")->fetch();
}



?>
<section>
    <div>
        <div>
            <h1>Éditer votre profil</h1>
            <h3>Pour modifier une information, inscrivez une nouvelle valeur dans le champ correspondant.</h3>
        </div>
        <div>
            <form action="" method ="POST" enctype="multipart/form-data">
                <div>
                    <label for="nom">Nom</label><br>
                    <input type="text" name = "nom" id="nom" placeholder = "<?php echo $donnees_utilisateur['nom'];?>">
                </div>
                <div>
                    <label for="prenom">Prénom</label><br>
                    <input type="text" name="prenom" id="prenom" placeholder = "<?php echo $donnees_utilisateur['prenom'];?>">
                </div>
                <div>
                    <label for="courriel">Courriel</label><br>
                    <input type="email" name="email" id="email"  placeholder = "<?php echo $donnees_utilisateur['email'];?>">
                </div>
                <div>
                    <label for="pdp">Image de profil (formats acceptés : jpg, jpeg, png, gif)</label><br>
                    <img style="width:100px;" src="<?php echo $donnees_utilisateur['image_profil'];?>" alt="photo de profil"><br>
                    <input type="file" id="pdp" name="img"  placeholder ="modifier...">
                </div>
                    <label for="mdp1">Ancien mot de passe</label><br>
                    <input type="password" name="ancienMDP" id="mdp1">
                </div>
                <div>
                    <label for="mdp2">Nouveau mot de passe</label><br>
                    <input type="password" name="nouveauMDP" id="mdp2">
                </div>
                <div>
                    <label for="mdp2conf">Retapez votre nouveau mot de passe : </label><br>
                    <input type="password" name="nouveauMDPConf" id="mdp2conf">
                </div>
                <div>
                    <input type="submit" value="Confirmer la modification">
                </div>
            
            </form>
        </div>
    </div>
</section>
<?php include("inc/footer.php");?>