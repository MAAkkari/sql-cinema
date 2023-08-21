<?php 
ob_start();
?>
<div id="parallax_bloc" style="margin-top: 17%;">
        <div id="parallax_background"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 style="font-size:2rem">AJOUTER UN GENRE</h2><h2 class="point_rouge" style="font-size:4rem">.</h2></div>
            <p style="margin-top:-27px;">Consulter le plus tard !</p>
        </div>
</div>
<!-- affiche un formulaire pour ajouter un nouveau genre avec les differents films qui sont de ce genre -->
 <form class="formulaire_film" action="/sql-cinema/index.php?action=NvGenre" method="post" >
    <p>
        <label> 
            Libellé du genre </label>
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

<?php
$title="Nouveau genre";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');