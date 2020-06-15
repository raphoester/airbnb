<?php include('inc/header.php');?>
<?php 
    if (empty($_SESSION["login_adm"]) || $_SESSION["login_adm"] != 1)
    {
        header("Location: connexion.php");
        exit();   
    }
?>




<?php include('inc/footer.php');?>