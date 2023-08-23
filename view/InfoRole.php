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
    <div class="delete_container">
        <button onclick="document.querySelector('.overlay2').classList.add('active-overlay') ; document.getElementById('help').classList.add('helpActive')" class="delele_button"> Effacer ce Role </button>
    </div>
<div id="help">
<i class="fa-solid fa-trash"></i>
    <h3>Etes vous sure de vouloir supprimer Ce Role ?</h3> <br>
    <p><span style="color:red">Attention &nbsp;<i class="fa-solid fa-triangle-exclamation"></i> &nbsp;</span>: &nbsp;cette suppression est definitive est supprimeras egalement tout les elements en relation avec lui !</p>
        <div class="yes_no">
        <a href="/sql-cinema/index.php?action=DeleteRole&id=<?= $roles[0]["id_role"] ?>">Oui</a>
        <button onclick="document.querySelector('.overlay2').classList.remove('active-overlay') ; document.getElementById('help').classList.remove('helpActive')">Non</button>
        </div>
</div>

    



<?php
$title="Details du role";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');
