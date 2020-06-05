<?php include("inc/header.php");?>


<?php
if (!empty($_POST))
{
    $refuser = False;
    if ($_POST["mdp_confirme"] != $_POST["mdp"])
    {
        echo "Les deux mots de passe ne correspondent pas.<br>";
        $refuser = True;
    }

    foreach ($pdo->query("SELECT email FROM utilisateur;") as $row)
    {
        if (($row["email"] == $_POST["email"]))
        {
            echo "Cette adresse email est déjà associée à un compte<br>";
            $refuser = True;
        }
    }

    if($refuser == False)
    {
        $prenom = str_replace("'", "\'", $_POST['prenom']);
        $prenom = str_replace('"', "\"", $prenom);
    
        $nom = str_replace("'", "\'", $_POST['nom']);
        $nom = str_replace('"', "\"", $nom);
    
        $email = str_replace("'", "\'", $_POST['email']);
        $email = str_replace('"', "\"", $email);

        if ($_POST["sexe"] == "h")
        {$sexe = "m";}
        $mot_de_passe = md5($_POST["mdp"]);
        $sql = "insert into utilisateur(prenom, nom, sexe, email, date_creation_compte, statut, mot_de_passe) values('$prenom', '$nom', '$sexe', '$email', CURDATE(), 'Nouvel arrivant', '$mot_de_passe');";
        echo $sql;
        $result = $pdo->exec($sql);
        header("Location: connexion.php");
        exit();
    }
}
?>



<h1>Créer un compte</h1>
<form action="" method="POST">
<div>
<label for="nom">Nom</label>
<input type="text" name="nom" id="nom" required>
</div>

<div>
<label for="prenom">Prénom</label>
<input type="text" name="prenom" id="prenom" required>
</div>

<div>
<label for="sexe">Sexe</label>
<select id="sexe" name="sexe">
  <option value="h" selected>Homme</option> 
  <option value="f">Femme</option>
</select>
</div>

<div>
<label for="email">Adresse mail</label>
<input type="email" name="email" id="email" required>
</div>

<div>
<label for ="mdp">Choisissez un mot de passe</label>
<input type="password" name="mdp" required>
</div>

<div>
<label for ="mdp">Confirmation du mot de passe</label>
<input type="password" name="mdp_confirme" required>
</div>

<div>
<label for="validation"></label>
<input type="submit" value="Créer mon compte" name="valider" id="validation">
</div>

</form>

<div>
<p>Vous préférez <a href="connexion.php">vous connecter</a> ? </p>
</div>

<?php include("inc/footer.php");?>