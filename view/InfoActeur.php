<?php session_start();
    ob_start();
    $infActeur=$requete->fetchAll() ;
?>

    <main> 
    <div id="parallax_bloc" >
            <div id="parallax_background"></div>
            <div id="TextAndBtn_parallax">

            <?php if (count($infActeur) > 0) { ?>



                <div class="titre_page"><h2 class="font-size-header-info-acteur-mobile"> <?= $infActeur[0]["prenom_acteur"]." ".$infActeur[0]["nom_acteur"]  ?> </h2><h2 class="point_rouge" >.</h2></div>
                <p style="margin-top:-27px;">TOUTES LES INFORMATIONS ! </p>
            </div>
        </div>

        <div class="details_and_picture">
            <img src=" <?=$infActeur[0]["photo"]?> " alt="picture of <?= $infActeur[0]["prenom_acteur"]." ".$infActeur[0]["nom_acteur"]  ?>">
            <div class="details_film">
                <div class="titre_note"> 
                    <h3> <?= $infActeur[0]["prenom_acteur"]." ".$infActeur[0]["nom_acteur"]  ?></h3> 
                </div>
                <p>Néé le :<?= $infActeur[0]["naissance_acteur"]  ?></p>
                <p>Age : <?= $infActeur[0]["age_acteur"] ?> Ans </p>
            </div> 
           
                
               
           </div>
          
        </div>
        
          

             
             <h2 class="soustitre_homepage"><br> <?= $infActeur[0]["prenom_acteur"]." ".$infActeur[0]["nom_acteur"]  ?> a jouer dans  </h2>
    <div class="liste_films">
        <?php foreach ($infActeur as $acteur) { ?> 

            <div class="film_individuel" >
                <div class="img_hover">
                    <a href="index.php?action=infoFilm&id=<?= $acteur['id_film'] ?>">
                        <img src="<?=$acteur['affiche']?>" alt="affiche de <?=$acteur['titre']?>">
                    </a>
                        <div class="Blog_Author_Date">
                            <a style="color :white;" class="info_film" href="/sql-cinema/index.php?action=infoRole&id=<?= $acteur["Id_role"] ?>"><?= $infActeur[0]["prenom_acteur"]." ".$infActeur[0]["nom_acteur"]  ?> joue <span style="color :#F81111;"> <?= $acteur["personnage"]?> </span> dans ce film </a>   
                        </div>
                </div>
                <a href="index.php?action=infoFilm&id=<?= $acteur['id_film'] ?>"><?=$acteur['titre']?></a>
            </div>
        <?php } ?>
    </div>
        
 <?php }
    else { echo "Cet acteur n'a jouer dans aucun film, crée un film et ajouter le !";}?>  





   
     

<?php 
$title="Information de l'acteur";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');