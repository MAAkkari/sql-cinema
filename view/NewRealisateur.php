<?php 
ob_start();
?>
<div id="parallax_bloc" style="margin-top: 17%;">
        <div id="parallax_background"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 style="font-size:1.5rem">AJOUTER UN REALISATEUR</h2><h2 class="point_rouge" style="font-size:4rem">.</h2></div>
            <p style="margin-top:-27px;">Consulter le plus tard !</p>
        </div>
</div>
<!-- formulaire pour ajouter un nouveau realisateur -->
 <form class="formulaire_film" action="/sql-cinema/index.php?action=NvRealisateur" method="post" enctype="multipart/form-data">
    <p>
        <label> 
            Nom du realisateur 
            <input class='input_acteur' type="text" name="name_realisateur" required>
        </label>
    </p>
    <p>
        <label>
            Prenom du realisateur 
            <input class='input_acteur' type="text" name="prenom_realisateur" required>
        </lavel>
    </p>
    
    <p>
        <label >
            Date de naissance 
            <input class='input_acteur' type="date" name="naissance_realisateur" required>
        </label>
    </p>
    
        
        <div class="upload-container">
        <input placeholder="Ajouter un fichier " class='input-file' id="document-upload" type="file" name="image_realisateur" required>
            <label for="document-upload" class="upload-button">Ajouter une Photo</label>
        </div>
    
    <p>
        <label>
            Sexe
            <select class='input_acteur select_film' name="sexe_realisateur" required>
                <option value="female">Femme</option>
                <option value="male">Homme</option>
            </select>
        </label>
    </p>
    <p>
        <input id="boutton_film" class="boutton_film" type="submit" name="submit" value="Submit !">
    </p>
    
 </form>
        
<?php
$title="Nouveau Réalisateur";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');