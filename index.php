<?php include("inc/header.php");?>


<h1>Partez en vacances.</h1>
<h3>Mais où ?</h3>
<h3>Quand ?</h3>
<h3>Telle est la question.</h3>

<form action="recherche.php", method=GET>
    <div>
        <label>Ville</label>
        <input type="text" placeholder="Où allez-vous ?" name = "ville" required>
    </div>
    <div>
        <label>Arrivée</label>
        <input type = "date" name = "dA" required>
    </div>
    <div>
        <label>Départ</label>
        <input type="date" name="dD" required>
    </div>
    <div>
        <label>Nombre de places</label>
        <input type="number" min="1" max="999" name = "places">
    </div>
    <div>
        <label>Rechercher</label>
        <input type="submit">
    </div>
</form>




<?php include("inc/footer.php");?>