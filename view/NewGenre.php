<?php 
ob_start();
?>
<div id="parallax_bloc" >
        <div id="parallax_background"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 class="font-size-header-info-acteur-mobile">AJOUTER UN GENRE</h2><h2 class="point_rouge" >.</h2></div>
            <p style="margin-top:-27px;">Consulter le plus tard !</p>
        </div>
</div>
<?php  
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){?>     
        <h3 class="message_ajout"><?= $_SESSION["message"][0]   ?></h3>
        
    <?php } 
        $_SESSION["message"]=[];
    ?>
<!-- affiche un formulaire pour ajouter un nouveau genre avec les differents films qui sont de ce genre -->
 <form class="formulaire_film" action="/sql-cinema/index.php?action=NvGenre" method="post" >
    <p>
        <label> 
            Libellé du genre </label><br>
            <input id="libelle_genre" class='input_role' type="text" name="libelle" required>
        
    </p>
    <p class='p_flex'>
        <label>
            films qui sont de ce genre 
        </label><br>
            <select id='multi_champ' class='input_role select_film' name="films[]" multiple>
                <option value="">None</option>
            <?php foreach ($requete->fetchAll() as $film) { ?>
                <option value="<?=$film['titre_film']?>"> <?= $film["titre_film"] ?> </option>
            <?php }?>
            </select>
        
    </p>
    <p>
        <input id ="boutton_film" class="boutton_film" type="submit" name="submit" value="Ajouter le Genre">
    </p>

    <script>document.addEventListener("DOMContentLoaded", function() {
    const elementToDisappear = document.querySelector(".message_ajout");
  
    setTimeout(function() {
      elementToDisappear.classList.add("disappear");
    }, 3000); // 3000 milliseconds (3 seconds) delay
  });</script>

<?php
$title="Nouveau genre";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');