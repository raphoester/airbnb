<?php include('inc/header.php');?>
<?php 
    if (empty($_SESSION["login_adm"]) || $_SESSION["login_adm"] != 1)
    {
        header("Location: connexion.php");
        exit();   
    }

?>


<section>
    <div>
        <div>
            <h1>Administration</h1>
        </div>
        <div>
            <ul>
                <li>
                    <a href="signalements.php">Signalements</a>
                </li>
                <li>
                    <a href="listedesmembres.php">Liste des membres</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<?php include('inc/footer.php');?>