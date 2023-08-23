<?php 
ob_start();
?>
<div id="parallax_bloc" >
        <div id="parallax_background"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 class="font-size-header-info-acteur-mobile">AJOUTER UN REALISATEUR</h2><h2 class="point_rouge" >.</h2></div>
            <p style="margin-top:-27px;">Consulter le plus tard !</p>
        </div>
</div>
<?php  
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){?>     
        <h3 class="message_ajout"><?= $_SESSION["message"][0]   ?></h3>
        
    <?php } 
        $_SESSION["message"]=[];
    ?>
<!-- formulaire pour ajouter un nouveau realisateur -->
 <form class="formulaire_film" action="/sql-cinema/index.php?action=NvRealisateur" method="post" enctype="multipart/form-data">
    <p>
        <label> 
            Nom du realisateur </label> <br>
            <input class='input_acteur' type="text" name="name_realisateur" required>
        
    </p>
    <p>
        <label>
            Prenom du realisateur </lavel><br>
            <input class='input_acteur' type="text" name="prenom_realisateur" required>
        
    </p>
    
    <p>
        <label >
            Date de naissance </label><br>
            <input class='input_acteur' type="date" name="naissance_realisateur" required>
        
    </p>
    
        
        <div class="upload-container">
        <input placeholder="Ajouter un fichier " class='input-file' id="document-upload" type="file" name="image_realisateur" required>
            <label for="document-upload" class="upload-button">Ajouter une Photo</label>
        </div>
    
    <p>
        <label>
            Sexe  </label>
            <select class='input_acteur select_film' name="sexe_realisateur" required>
                <option value="female">Femme</option>
                <option value="male">Homme</option>
            </select>
       
    </p>
    <p>
        <input id="boutton_film" class="boutton_film" type="submit" name="submit" value="Submit !">
    </p>
    
 </form>
        <script>document.addEventListener("DOMContentLoaded", function() {
    const elementToDisappear = document.querySelector(".message_ajout");
  
    setTimeout(function() {
      elementToDisappear.classList.add("disappear");
    }, 3000); // 3000 milliseconds (3 seconds) delay
  });</script>
<?php
$title="Nouveau Réalisateur";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');