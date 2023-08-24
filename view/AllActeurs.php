<?php 
    ob_start();
    
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
    <?php  
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){?>     
        <h3 class="message_ajout"><?= $_SESSION["message"][0]   ?></h3>
        
    <?php } 
        $_SESSION["message"]=[];
    ?>

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

<script>
    ocument.addEventListener("DOMContentLoaded", function() {
    const elementToDisappear = document.querySelector(".message_ajout");
  
    setTimeout(function() {
      elementToDisappear.classList.add("disappear");
    }, 3000); // 3000 milliseconds (3 seconds) delay
    });
</script>




<?php
$title="Liste des acteurs";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');
