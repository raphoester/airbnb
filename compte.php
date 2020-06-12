<?php include("inc/header.php");?>
<?php

if (empty($_SESSION["login"]) || $_SESSION["login"] != 1)
{
    header("Location: connexion.php");
    exit();   
}?>

<div class="container my-5">


  <!--Section: Content-->
  <section class="dark-grey-text text-center">
    <!-- Section heading -->
    <h3 class="font-weight-bold black-text mb-4 pb-2">Bonjour <?php echo $donnees_utilisateur["prenom"];?> !</h3>
    <hr class="w-header">
    <!-- Section description -->
    <p class="lead text-muted mx-auto mt-4 pt-2 mb-5">Que voulez vous faire ?</p>

    <!--First row-->
    <div class="row">

        <!--Grid column-->
        <div class="col-md-4 mb-5">

        <!-- Card -->
        <a href="messages.php" class="card hoverable">
            
            <!-- Card content -->
            <div class="card-body my-4">

            <h2><i class="envelope outline icon text-muted"></i></h2>
            <h5 class="black-text mb-0">Messagerie</h5>
            
            </div>

        </a>
        <!-- Card -->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-5">

        <!-- Card -->
        <a href="editinfo.php" class="card hoverable">
            
            <!-- Card content -->
            <div class="card-body my-4">

            <h2><i class="cogs icon text-muted"></i></h2>
            <h5 class="black-text mb-0">Éditer vos informations</h5>
            
            </div>

        </a>
        <!-- Card -->

        </div>
        <!--Grid column-->
        
        <!--Grid column-->
        <div class="col-md-4 mb-4">

        <!-- Card -->
        <a href="reservations.php" class="card hoverable">
            
            <!-- Card content -->
            <div class="card-body my-4">

            <h2><i class="calendar icon text-muted"></i></h2>
            <h5 class="black-text mb-0">Vos réservations</h5>
            
            </div>

        </a>
        <!-- Card -->

        </div>
        <!--Grid column-->
        
        <!--Grid column-->
        <div class="col-md-4 mb-4">

        <!-- Card -->
        <a href="mesannonces.php" class="card hoverable">
            
            <!-- Card content -->
            <div class="card-body my-4">

            <h2><i class="pencil alternate icon text-muted"></i></h2>
            <h5 class="black-text mb-0 ">Vos annonces</h5>
            
            </div>

        </a>
        </div>

        <div class="col-md-4 mb-4">

        <!-- Card -->
        <a href="nouvelleannonce.php" class="card hoverable">
            
            <!-- Card content -->
            <div class="card-body my-4">

                <h2><i class="plus icon text-muted"></i></h2>
                <h5 class="black-text mb-0">Créer une nouvelle annonce</h5>
                
            </div>

        </a>
        </div>

        <div class="col-md-4 mb-4">

        <!-- Card -->
        <a href="?dec=True" class="card hoverable">
            
            <!-- Card content -->
            <div class="card-body my-4">

                <h2><i class="power off icon text-muted"></i></h2>
                <h5 class="black-text mb-0">Se déconnecter</h5>
                
            </div>

        </a>
        </div>
    </div>

</a>
    <!--First row-->

</section>
  
  
</div>

<!-- jQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>
<?php include("inc/footer.php");?>