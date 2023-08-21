<?php 
    ob_start();
    session_start();
// affiche une liste tout les roles
    ?>





<div id="parallax_bloc">
        <div id="parallax_background"></div>
            <div id="TextAndBtn_parallax">
                <div class="titre_page"><h2>ROLES</h2><h2 class="point_rouge">.</h2></div>
                <p>RETROUVER VOS ROLES FAVORIS !</p>
            </div>
    </div> 
    <h2 class="soustitre2_homepage">Tout Les roles</h2>


<div class="genres_populaires">
    <?php  foreach($requete->fetchAll() as $role) { ?>
        <a class="role_nom" href="/sql-cinema/index.php?action=infoRole&id=<?php echo $role["Id_role"] ?>">
           <?php echo $role["nom_role"]?></a>  
    <?php } ?> 
</div>
</main> 

<?php
$title="Liste des roles";
$titre_secondaire="Tout les Roles";
$contenu = ob_get_clean();
require_once('template.php');