<?php 
    ob_start();
    ?>
<main>
    <div id="parallax_bloc">
        <div id="parallax_background"></div>
            <div id="TextAndBtn_parallax">
                <div class="titre_page"><h2>REALISATEURS</h2><h2 class="point_rouge">.</h2></div>
                <p>RETROUVER VOS REALISATEURS FAVORIS !</p>
            </div>
    </div> 
    <?php  
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){?>     
        <h3 class="message_ajout"><?= $_SESSION["message"][0]   ?></h3>
        
    <?php } 
        $_SESSION["message"]=[];
    ?>


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
<script>
    ocument.addEventListener("DOMContentLoaded", function() {
    const elementToDisappear = document.querySelector(".message_ajout");
  
    setTimeout(function() {
      elementToDisappear.classList.add("disappear");
    }, 3000); // 3000 milliseconds (3 seconds) delay
    });
</script>
<?php 
$title="Liste des Réalisateurs";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');