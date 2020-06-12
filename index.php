<?php include("inc/header.php");?>

<div class="type">

    <h1>Partez en vacances.</h1>
    <h3>Mais où ?</h3>
    <h3>Quand ?</h3>
    <h3>Telle est la question.</h3>

    <form id="form" class="recherche" action="recherche.php" method=GET>
        <div class="ui form">
            <div class="three fields">
                <div class="field">
                    <label for="ville">Ville</label>
                    <input type="text" placeholder="Ou aller ?" name = "ville" id="ville" required>
                </div>

                <div class="field">
                    <label for="date">Date d'arrivée</label>
                    <input type="date" name = "dA" id="date" required>
                </div>

                <div class="field">
                    <label for="dD">Date de départ</label>
                    <input type="date" name="dD" id="dD" required>
                </div>
            </div>
            
            <div class="three fields">
                <div class = "field">
                    <label for="places">Nombre de places</label>
                    <input type="number" min="1" max="999" name = "places" id="places" required>
                </div>

                <div class="field">
                    <label for="prixMin">Prix minimum (par jour et par personne)</label>
                    <input type="number" name="prixMin" min = 0 max = 100000 id="prixMin">
                </div>

                <div class="field">
                    <label for="prixMax">Prix maximum  (par jour et par personne)</label>
                    <input type="number" name="prixMax" min = 0 max = 100000 id="prixMax">
                </div>
            </div>
                <div class="btn_ajt">
                    <button type="submit" form="form" name="button" class="btn btn-light">Rechercher</button>
                </div>
            
        </div>
        
        <?php include("inc/footer.php");?>
</div>