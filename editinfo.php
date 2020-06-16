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
    $pdo->exec($sql);

}


if (!empty($_POST))
{
    if(!empty($_POST["nom"]))
    {
        $_POST["nom"]= str_replace("'", "\'", $_POST['nom']);
        $_POST["nom"] = str_replace('"', '\"', $_POST["nom"]);

        $sql = "update utilisateur set nom ='". $_POST['nom']."'where id_utilisateur =".$donnees_utilisateur['id_utilisateur'].";";
        $pdo->exec($sql); 
    }
    
    if(!empty($_POST["prenom"]))
    {
        $_POST["prenom"]= str_replace("'", "\'", $_POST['prenom']);
        $_POST["prenom"] = str_replace('"', '\"', $_POST["prenom"]);

        $sql = "update utilisateur set prenom ='". $_POST['prenom']."'where id_utilisateur =".$donnees_utilisateur['id_utilisateur'].";";
        $pdo->exec($sql); 
    }
    
    if(!empty($_POST["email"]))
    {
        $_POST["email"]= str_replace("'", "\'", $_POST['email']);
        $_POST["email"] = str_replace('"', '\"', $_POST["email"]);

        $sql = "update utilisateur set email ='". $_POST['email']."'where id_utilisateur =".$donnees_utilisateur['id_utilisateur'].";";
        $pdo->exec($sql); 
    }

    if(!empty($_POST["ancienMDP"]) && !empty($_POST["nouveauMDP"]) && !empty($_POST["nouveauMDPConf"]) && (md5($_POST["ancienMDP"]) == $donnees_utilisateur["mot_de_passe"]) && (md5($_POST["nouveauMDP"]) == md5($_POST["nouveauMDPConf"])))
    {
        $sql = "update utilisateur set mot_de_passe ='". md5($_POST['nouveauMDP'])."'where id_utilisateur =".$donnees_utilisateur['id_utilisateur'].";";
        $pdo->exec($sql);
    }
    $donnees_utilisateur = $pdo->query("select * from utilisateur where id_utilisateur = ".$donnees_utilisateur['id_utilisateur'].";")->fetch();
}



?>

<div class="editinfo">
    <div class="ui placeholder segment">
        <div class="column">
            <h3 class="ui dividing header">Éditer votre profil</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="ui form">
                    <div class="field">
                        <label for="nom">Nom</label>
                        <div class="ui left icon input">
                            <input type="text" name = "nom" id="nom" placeholder = "<?php echo $donnees_utilisateur['nom'];?>">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="prenom">Prenom</label>
                        <div class="ui left icon input">
                            <input type="text" name="prenom" id="prenom" placeholder = "<?php echo $donnees_utilisateur['prenom'];?>">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="courriel">Email</label>
                        <div class="ui left icon input">
                            <input type="email" name="email" id="email" placeholder = "<?php echo $donnees_utilisateur['email'];?>">
                            <i class="at icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="pdp">Image de profil (formats acceptés : jpg, jpeg, png, gif)</label>
                        <img class="pdp" style="width:50px" height="40px" src="<?php echo $donnees_utilisateur['image_profil'];?>" alt="photo de profil">
                        <div>
                            <input type="file" id="pdp" name="img"  placeholder ="modifier...">
                        </div>
                    </div>
                    <div class="field">
                        <label for="mdp1">Ancien mot de passe</label>
                        <div class="ui left icon input">
                            <input type="password" name="ancienMDP" id="mdp1">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="mdp2">Nouveau mot de passe</label>
                        <div class="ui left icon input">
                            <input type="password" name="nouveauMDP" id="mdp2">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label for="mdp2conf">Confirmation mot de passe</label>
                        <div class="ui left icon input">
                            <input type="password" name="nouveauMDPConf" id="mdp2conf">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <input class="ui blue submit button" type="submit" value="Confirmer la modification"></input>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("inc/footer.php");?>