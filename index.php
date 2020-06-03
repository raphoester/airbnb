<?php include("inc/header.php");?>


<h1>Partez en vacances.</h1>
<h3>Mais où ?</h3>
<h3>Quand ?</h3>
<h3>Telle est la question.</h3>

<form action="recherche.php", method=GET>
    <label>Ville</label>
    <input type="text" placeholder="Où allez-vous ?" name = "ville" required>

    <label>Arrivée</label>
    <input type = "date" name = "dA" required>

    <label>Départ</label>
    <input type="date" name="dD" required>

    <label>Nombre de places</label>
    <input type="number" min="1" max="999" name = "places">
    
    <label>Rechercher</label>
    <input type="submit">
</form>




<?php include("inc/footer.php");?>