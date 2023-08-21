<?php 
ob_start();
?>




<div id="parallax_bloc" style="margin-top: 17%;">
        <div id="parallax_background"></div>
        <div id="TextAndBtn_parallax">
                
            <div class="titre_page"><h2 style="font-size:2rem">AJOUTER UN ACTEUR</h2><h2 class="point_rouge" style="font-size:4rem">.</h2></div>
            <p style="margin-top:-27px;">Consulter le plus tard !</p>
        </div>
</div>
<!-- affiche un formulaire qui permet de crée un nouvel acteur et de selectionner les roles qu'il a jouer dans differents films -->
<form class="formulaire_film" action="/sql-cinema/index.php?action=NvActeur" method="post" enctype="multipart/form-data">
    <p>
        <label> Nom de l'acteur</label>
            <input class='input_acteur' type="text" name="name_acteur" required>
        
    </p>
    <p>
        <label>
            Prenom du acteur</lavel> 
            <input class='input_acteur' type="text" name="prenom_acteur" required>
        
    </p>
    <p>
        <label>
            Sexe
            <select class='select_film' name="sexe_acteur" required>
                <option value="female">Femme</option>
                <option value="male">Homme</option>
            </select>
        </label>
    </p>
    <p>
        <label >
            Date de naissance 
            <input class='input_acteur' type="date" name="naissance_acteur" required>
        </label>
    </p>
        <div class="upload-container">
        <input placeholder="Ajouter un fichier " class='input-file' id="document-upload" type="file" name="image_acteur" required>
            <label for="document-upload" class="upload-button">Ajouter une Photo</label>
        </div>
    <?php 
    $films=$requete1->fetchAll() ;
    $roles=$requete2->fetchAll() 
    ?>
    <div id="film_actor_selector">
        <p class="film_actor_line">
            <label>
                cet acteur a jouer <br>
            </label>
            <select class='input_acteur select_film' name="roles_acteur[]" >
                <option value="">None</option>
                <?php foreach ($roles as $role) { ?>
                    <option value="<?=$role['nom_role']?>"> <?= $role["nom_role"] ?> </option>
                <?php }?>
            </select> 
            &nbsp dans le film
            <select class='input_acteur select_film' name="films_acteur[]" >
                <option value="">None</option>
                <?php foreach ($films as $film) { ?>
                    <option value="<?=$film['titre_film']?>"> <?= $film["titre_film"] ?> </option>
                <?php }?>
            </select>     
        </p>
        <button type="button" class='acteur+' id="film_actor_button2"  >+</button>
    </div>
   
    
        <input id ="boutton_film" class="boutton_film" type="submit" name="submit" value="Submit !">
    
</form>



<script>
    const div = document.getElementById("film_actor_selector")
    const ligne_ajout = document.querySelector(".film_actor_line")
    const bouton_nv_ligne = document.querySelector("#film_actor_button2")

bouton_nv_ligne.addEventListener("click" , function() {
    const new_ligne_ajout = ligne_ajout.cloneNode(true)
    film_actor_selector.appendChild(new_ligne_ajout)
    }) ;
</script>

<?php
$title="Nouvel Acteur";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');