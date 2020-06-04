<?php include("inc/header.php");?>


<?php 
if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    
    header("Location: connexion.php");
    exit();   
}
else if(!empty($_POST))
{
    $result = $pdo->exec("INSERT INTO experiences (titre, entreprise, description, date_debut, date_fin) VALUES('".$_POST['titreExperience']."','".$_POST['entrepriseExperience']."','".$_POST['descriptionExperience']."','".$_POST['dateDebutExperience']."','".$_POST['dateFinExperience']."');");



}



?>


<div>
    <div>
        <h1>Créer une annonce</h1>
    </div>
    <div>
        <form action="" method = "post">
        <div>
            <label for="titre">Titre de l'annonce</label>
            <input type="text" name="titre" required>
        </div>
        <div>
            <label for="desc">Description</label>
            <textarea name="description" id="desc" cols="30" rows="5" required></textarea>
        </div>
        <div>
            <label for="prix">Prix par jour</label>
            <input type="number" min="1" step="any" value="" id="prix" name="prix" required>€
        </div>

        <div>
            <label for="ville">Ville</label>
            <input type="text" id="ville" placeholder="Paris" required>
        </div>

        <div>
            <label for="places">Nombre maximal de locataires</label>
            <input type="number" min="1" id="places" name="places" max = 150 required>
        </div>

        <div>
            <input type="submit" value = "Valider !">
        </div>

        
        </form>
    </div>
</div>
<?php include("inc/footer.php");?>