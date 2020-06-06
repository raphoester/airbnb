<?php include("inc/header.php");?>


<?php 

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
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
}



?>
<section>
    <div>
        <div>
            <h1>Éditer votre profil</h1>
        </div>
        <div>
            <form action="" method ="POST">
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" name = "nom" id="nom">
                </div>
                <div>
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom">
                </div>
                <div>
                    <label for="courriel">Courriel</label>
                    <input type="email" name="email" id="email">
                </div>
                <div>
                    <label for="mdp1">Ancien mot de passe</label>
                    <input type="password" name="ancienMDP" id="mdp1">
                </div>
                <div>
                    <label for="mdp2">Nouveau mot de passe</label>
                    <input type="password" name="nouveauMDP" id="mdp2">
                </div>
                <div>
                    <label for="mdp2conf">Retapez votre nouveau mot de passe : </label>
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