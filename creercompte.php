<?php include("inc/data.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb</title>
    
    <script
      src="https://kit.fontawesome.com/c96b06a653.js"
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="css/login.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    
    <script src="semantic/dist/semantic.min.js"></script>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
</head>
<body>
<header>
    <div class="logo">
        <a href="index.php">
            <img src="img/logo_airbnb.jpg" alt="logo" href="index.php">
        </a>
    </div>
</header>

<div class="sign_up">
    <div class="ui placeholder segment">
            <div class="column">
                <h3 class="ui dividing header">Créer un compte</h3>
                <form action="" method="POST">
                    <div class="ui form">
                        <div class="field">
                            <label>Nom</label>
                            <div class="ui left icon input">
                                <input type="text" name="nom" id="nom" required>
                                <i class="user icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label>Prenom</label>
                            <div class="ui left icon input">
                                <input type="text" name="prenom" id="prenom" required>
                                <i class="user icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label>Sexe</label>
                            <div class="ui left icon input">
                                <select class="test" id="sexe" name="sexe">
                                    <option value="h" selected>Homme</option> 
                                    <option value="f">Femme</option>
                                </select>
                                <i class="address card icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label>Email</label>
                            <div class="ui left icon input">
                                <input type="email" name="email" id="email" required>
                                <i class="at icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label>Mot de passe</label>
                            <div class="ui left icon input">
                                <input type="password" name="mdp" required>
                                <i class="lock icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label>Confirmation du mot de passe</label>
                            <div class="ui left icon input">
                                <input type="password" name="mdp_confirme" required>
                                <i class="lock icon"></i>
                            </div>
                        </div>
                        <input class="ui blue submit button" type="submit" value="Créer mon compte" name="valider" id="validation"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>


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