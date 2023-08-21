<?php 
    ob_start(); 
    $roles=$requete->fetchAll()
?>
<main>

<div id="parallax_bloc" style="margin-top: 17%;">
        <div id="parallax_background2"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 style="font-size:2rem"><?= $roles[0]["personnage"] ?></h2><h2 class="point_rouge" style="font-size:4rem">.</h2></div>
            <p style="margin-top:-27px;">TOUTES LES INFORMATIONS ! </p>
        </div>
</div>


<h2 class="soustitre_homepage"><br> Ce role est interpreter par </h2>
    <div class="liste_films" >
        <?php foreach ( $roles as $role) { ?> 

            <div class="film_individuel" >
                <div class="img_hover">
                    <a   href="index.php?action=infoFilm&id=<?= $role["id_film"] ?>">
                        <img  src=" <?= $role["affiche"] ; ?> " alt="affiche de <?=$role["titre"]?>">
                    </a>
                </div>


                <p style="max-width:130px ; min-height:80px">
                  <a style="font-size:1rem ; color:red;" href="/sql-cinema/index.php?action=infoActeur&id= <?= $role["id_acteur"] ?>"> <?=$role["prenom_acteur"]." ".$role["nom_acteur"] ?> </a>
                    <a style="font-size:1rem ; " href="index.php?action=infoFilm&id=<?= $role["id_film"] ?>">Dans <?= $role["titre"]  ?></a> <br>
                   
                    
                </p>

            </div>

        <?php } ?>
    </div>




<?php
$title="Details du role";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');
