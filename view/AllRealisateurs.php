<?php 
    ob_start();
    session_start(); ?>
<main>
    <div id="parallax_bloc">
        <div id="parallax_background"></div>
            <div id="TextAndBtn_parallax">
                <div class="titre_page"><h2>REALISATEURS</h2><h2 class="point_rouge">.</h2></div>
                <p>RETROUVER VOS REALISATEURS FAVORIS !</p>
            </div>
    </div> 

        <h2 class="soustitre_homepage"><br> Tout les Réalisateurs </h2>
    <div class="liste_films">
        <?php foreach($requete as $realisateur){ ?>

            <div class="film_individuel realisateurs ">
                
                    <a href="/sql-cinema/index.php?action=infoRealisateur&id=<?= $realisateur["id_auteur"] ?>">
                        <img src= " <?= $realisateur["photo"] ?>" alt= "Photo de <?= $realisateur["prenom"].' '.$realisateur["nom"] ?> ">
                    </a>
                
                <a href="/sql-cinema/index.php?action=infoRealisateur&id=<?= $realisateur["id_auteur"] ?>"> <?= $realisateur["prenom"]." ".$realisateur["nom"] ?></a> 
            </div>

        <?php } ?>
    </div>


</main>

<?php 
$title="Liste des Réalisateurs";
$titre_secondaire="Tout les réalisateurs";
$contenu = ob_get_clean();
require_once('template.php');