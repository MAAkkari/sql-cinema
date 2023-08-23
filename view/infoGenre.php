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
    <div class="delete_container">
        <button onclick="document.querySelector('.overlay2').classList.add('active-overlay') ; document.getElementById('help').classList.add('helpActive')" class="delele_button"> Effacer ce Role </button>
    </div>
<div id="help">
<i class="fa-solid fa-trash"></i>
    <h3>Etes vous sure de vouloir supprimer Ce Genre ?</h3> <br>
    <p><span style="color:red">Attention &nbsp;<i class="fa-solid fa-triangle-exclamation"></i> &nbsp;</span>: &nbsp;cette suppression est definitive est supprimeras egalement tout les elements en relation avec lui !</p>
        <div class="yes_no">
        <a href="/sql-cinema/index.php?action=DeleteGenre&id=<?= $genre[0]["id_genre"] ?>">Oui</a>
        <button onclick="document.querySelector('.overlay2').classList.remove('active-overlay') ; document.getElementById('help').classList.remove('helpActive')">Non</button>
        </div>
</div>



</main>

<?php
$genre=$requete->fetchAll() ;
$title="Info du genre";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');
