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
        header("Location: connexion.php");
        exit();
    }
}


?>



<h1>Créer un compte</h1>
<form action="" method="POST">

<label for="nom">Nom</label>
<input type="text" name="nom" id="nom" required>


<label for="prenom">Prénom</label>
<input type="text" name="prenom" id="prenom" required>

<label for="sexe">Sexe</label>
<select id="sexe">
  <option value="h" selected>Homme</option> 
  <option value="f">Femme</option>
</select>


<label for="email">Adresse mail</label>
<input type="email" name="email" id="email" required>

<label for ="mdp">Choisissez un mot de passe</label>
<input type="password" name="mdp" required>

<label for ="mdp">Confirmation du mot de passe</label>
<input type="password" name="mdp_confirme" required>

<label for="validation"></label>
<input type="submit" value="Créer mon compte" name="valider" id="validation">
</form>

<p>Vous préférez <a href="connexion.php">vous connecter</a> ? :)</p>
<?php include("inc/footer.php");?>