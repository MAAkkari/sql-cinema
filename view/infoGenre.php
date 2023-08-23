<?php 
    ob_start(); 
    $genre=$requete->fetchAll();
?>
<main>

<div id="parallax_bloc" >
        <div id="parallax_background"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 class="font-size-header-info-acteur-mobile"><?= $genre[0]["libelle"] ?></h2><h2 class="point_rouge" >.</h2></div>
            <p style="margin-top:-27px;">TOUTES LES INFORMATIONS ! </p>
        </div>
</div>

<a class="delele_button"href="/sql-cinema/index.php?action=DeleteGenre&id=<?= $genre[0]["id_genre"] ?>"> Effacer ce Genre </a>

<h2 class="soustitre_homepage"><br> Film du genre <?= $genre[0]["libelle"] ?> </h2>
    <div class="liste_films">
        <?php foreach ( $genre as $film) { ?> 

            <div class="film_individuel" >
                <div class="img_hover">
                    <a href="index.php?action=infoFilm&id=<?= $film["id_film"] ?>">
                        <img src= " <?= $film["affiche"] ; ?> " alt="affiche de <?=$film['titre_film']?>">
                    </a>
                        <div class="Blog_Author_Date">
                            <a class="info_film" href="/sql-cinema/index.php?action=infoRealisateur&id=<?= $film["id_auteur"] ?>">
                            De <?= $film["prenom"]." ".$film["nom"]  ?></a>
                            <p> <?= $film["durée_minute"] ; ?> Minutes </p>
                            <p>sortie le : <?= $film["année_sortie_fr"]  ?></p>
                        </div>
                    
                </div>
                <a href="index.php?action=infoFilm&id=<?= $film['id_film'] ?>"><?=$film['titre_film']?></a> 
            </div>

        <?php } ?>
    </div>




</main>

<?php
$genre=$requete->fetchAll() ;
$title="Info du genre";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');
