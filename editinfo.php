<?php include("inc/header.php");?>


<?php 

if (!empty($_POST))
{
    if(!empty($_POST["nom"]))
    {
        //PAS FINI
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