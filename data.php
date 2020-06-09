<?php 
    session_start();
    $pdo = new PDO("mysql:host=localhost; dbname=airbnb", "root", "" , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    if (!empty($_SESSION["id"])){
        $sql = "select * from utilisateur where id_utilisateur =". $_SESSION['id'].";";
        $pdostatementDU = $pdo->query($sql);
        $donnees_utilisateur = ($pdostatementDU->fetch());

        $donnees_utilisateur["nom"] = str_replace("'", "\'", $donnees_utilisateur['nom']);
        $donnees_utilisateur["nom"] = str_replace('"', "\"", $donnees_utilisateur["nom"]);

        $donnees_utilisateur["prenom"] = str_replace("'", "\'", $donnees_utilisateur['prenom']);
        $donnees_utilisateur["prenom"] = str_replace('"', "\"", $donnees_utilisateur["prenom"]);
    
        $donnees_utilisateur["email"] = str_replace("'", "\'", $donnees_utilisateur['email']);
        $donnees_utilisateur["email"] = str_replace('"', "\"", $donnees_utilisateur["email"]);

        $donnees_utilisateur["statut"] = str_replace("'", "\'", $donnees_utilisateur['statut']);
        $donnees_utilisateur["statut"] = str_replace('"', "\"", $donnees_utilisateur["statut"]);
    
    }
    if (!empty($_GET["dec"])){

        session_unset();
        session_destroy();
        setcookie("email", FALSE, time() - 3600, "/");
        setcookie("mdp", FALSE, time() - 3600, "/");
        header("location: index.php");
        exit();
    }



?>