<?php 
    ob_start(); 
    $roles=$requete->fetchAll()
?>
<main>

<div id="parallax_bloc" >
        <div id="parallax_background"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 class="font-size-header-info-acteur-mobile" ><?= $roles[0]["personnage"] ?></h2><h2 class="point_rouge" >.</h2></div>
            <p style="margin-top:-27px;">TOUTES LES INFORMATIONS ! </p>
        </div>
</div>

 <a class="delele_button"href="/sql-cinema/index.php?action=DeleteRole&id=<?= $roles[0]["id_role"] ?>"> Effacer ce Role </a>
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
