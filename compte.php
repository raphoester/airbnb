<?php include("inc/header.php");?>
<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}?>
<section>
<div>
    <div>
        <h1>Bienvenue <?php echo $donnees_utilisateur["prenom"];?> !</h1>
        <h2>Que voulez vous faire ?</h2>
    </div>
    <div>
        <ul>
            <li>
                <a href="messages.php">Messagerie</a>
            </li>
            <li>
                <a href="editinfo.php">Éditer vos informations</a>
            </li>
            <li>
                <a href="mesannonces.php">Vos annonces</a>
            </li>
            <li>
                <a href="reservations.php">Vos réservations</a>
            </li>
            <li>
                <a href="nouvelleannonce.php">Créer une nouvelle annonce</a>
            </li>
        </ul>
    </div>

</div>
</section>



<?php include("inc/footer.php");?>