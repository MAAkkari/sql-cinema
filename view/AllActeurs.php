<?php 
    ob_start();
    session_start();
// affiche tout les acteurs avec leur photo et leur date de naissance
?>
<main>
<div id="parallax_bloc">
        <div id="parallax_background"></div>
            <div id="TextAndBtn_parallax">
                <div class="titre_page"><h2>ACTEURS</h2><h2 class="point_rouge">.</h2></div>
                <p>RETROUVER VOS ACTEURS FAVORIS !</p>
            </div>
    </div> 

        <h2 class="soustitre_homepage"><br> Tout les Acteurs </h2>
    <div class="liste_films">
        <?php foreach($requete->fetchAll() as $acteur){ ?>

            <div class="film_individuel realisateurs ">
                <div class="img_hover">
                    <a href="/sql-cinema/index.php?action=infoActeur&id=<?= $acteur["id_acteur"] ?>">
                        <img src= " <?= $acteur["photo"] ; ?> " alt= "Photo de <?= $acteur["prenom"]." ".$acteur["nom"] ?> ">
                    </a>
                </div>
                <a class="info_film" href="/sql-cinema/index.php?action=infoActeur&id=<?php echo $acteur["id_acteur"] ?>"><?php echo $acteur["prenom"]." ".$acteur["nom"] ?></a>
            </div>

        <?php } ?>
    </div>




<?php
$title="Liste des acteurs";
$titre_secondaire="Tout les acteurs";
$contenu = ob_get_clean();
require_once('template.php');
