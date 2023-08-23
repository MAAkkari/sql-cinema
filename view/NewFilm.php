<?php 
ob_start();
?>

<div id="parallax_bloc" >
        <div id="parallax_background"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 class="font-size-header-info-acteur-mobile">AJOUTER UN FILM</h2><h2 class="point_rouge" >.</h2></div>
            <p style="margin-top:-27px;">Consulter le plus tard !</p>
        </div>
</div>
<?php  
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){?>     
        <h3 class="message_ajout"><?= $_SESSION["message"][0]   ?></h3>
        
    <?php } 
        $_SESSION["message"]=[];
    ?>

 
<!-- affiche un forumlaire pour ajouter un film et ses genre et realisateur -->
 <form class="formulaire_film" action="/sql-cinema/index.php?action=NvFilm" method="post" enctype="multipart/form-data">
    <p>
        <label>Titre</label><br>
            <input placeholder="Exemple : Titanic" class='input_film' id="input1" type="text" name="titre" required>
        
    </p>
    <p>
        <label >Année de sortie </label><br>
            <input  placeholder="JJ / MM / YYYY" class='input_film' id="input2" type="date" name="sortie" required>
        
    </p>
    <p>
        <label>Durée (minutes)</label><br>
            <input placeholder="Min" class='input_film' id="input3" type="number" name="duree" required min="0">
        
    </p>
    <p class='p_flex'>
        <label>synopsis</label><br>
        <textarea  placeholder="Résumé du film " class='input_film1' name="synopsis" rows="4" cols="50" placeholder="Entrer le synopsis"></textarea>
    </p>
    
        <div class="upload-container">
        <input onchange="updateFileName(this)" placeholder="Ajouter un fichier " class='input-file' id="document-upload" type="file" name="affiche" required>
            <label for="document-upload" class="upload-button">Ajouter une Affiche</label>
            <span style="color:white;" id="file-name"></span>
        </div>
    
    <p>
        <label>Note</label><br>
            <input placeholder="sur 5" class='input_film' id="input5" type="number" name="note" required min="0" max="5">
        
    </p>
    <?php 
    $realisateurs=$requete1->fetchAll() ;
    $genres=$requete2->fetchAll() 
    ?>

    <p>
        <label>Réalisateur</label><br>
        
        <select class='select_film' id="input6" name="realisateur_film" required>
            <?php foreach ($realisateurs as $realisateur) { ?>
                <option placeholder="Sélectionner" value="<?=$realisateur['nom_complet']?>"> <?= $realisateur["nom_complet"] ?> </option>
            <?php }?>
        </select> 
    </p>

    
   
    <p class="genre_film1"> 
    
        <div id="film_actor_selector">
        <button type="button"  id="film_actor_button" >+</button>
            <p class="film_actor_line">
                Genres
                <select placeholder="Sélectionner" class='input_film select_film' id="input7" name="genre_film[]">
                    <option value="">None</option>
                    <?php foreach ($genres as $genre) { ?>
                        <option value="<?=$genre['libelle']?>"> <?= $genre["libelle"] ?> </option>
                    <?php }?>
            </p>
            </select> 
        </div> 
    </p>
   
        <input  id="boutton_film" type="submit" name="submit" value="Submit !">
    
   
 </form>



<script>
    const div = document.getElementById("film_actor_selector")
    const ligne_ajout = document.querySelector(".film_actor_line")
    const bouton_nv_ligne = document.querySelector("#film_actor_button")

bouton_nv_ligne.addEventListener("click" , function() {
    const new_ligne_ajout = ligne_ajout.cloneNode(true)
    film_actor_selector.appendChild(new_ligne_ajout)
    });

    document.addEventListener("DOMContentLoaded", function() {
    const elementToDisappear = document.querySelector(".message_ajout");
  
    setTimeout(function() {
      elementToDisappear.classList.add("disappear");
    }, 3000); // 3000 milliseconds (3 seconds) delay
  });

  function updateFileName(input) {

const fileNameSpan = document.getElementById("file-name");

if (input.files.length > 0) {

    fileNameSpan.textContent = input.files[0].name;

} else {

    fileNameSpan.textContent = "";

}}
</script>

<?php
$title="Nouveau film";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');