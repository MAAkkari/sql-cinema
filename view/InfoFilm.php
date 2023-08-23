<?php session_start();
    ob_start(); ?>

<main> 
<?php $inffilm=$requete1->fetch() ;
$genres = explode(';', $inffilm['genres_details']);
?>

    <div id="parallax_bloc" >
            <div id="parallax_background"></div>
            <div id="TextAndBtn_parallax">
                
                <div class="titre_page"><h2 class="font-size-header-info-acteur-mobile"><?= $inffilm["titre"] ?></h2><h2 class="point_rouge" >.</h2></div>
                <p style="margin-top:-27px;">TOUTES LES INFORMATIONS ! </p>
            </div>
        </div>

        <div class="details_and_picture">
            <img src= " <?= $inffilm["affiche"] ; ?> " alt="">
            <div class="details_film">
                <div class="titre_note"> 
                    <h3 style="font-size:1.5rem; max-width :60%"> <?= $inffilm["titre"] ?></h3> 
                    <div class="note">
                        <?php for ($i=0;$i< $inffilm["note"];$i++) { ?> 
                            <span class="fa fa-star checked" id="etoile"></span>
                        <?php } 
                        $vide = 5 - $inffilm["note"];
                        for ($i = 0; $i < $vide; $i++) {
                            echo '<span class="fa fa-star checked" id="etoile_vide"></span>';
                        }
                        ?> 
                    </div>

                </div> 
                <p><?php echo $inffilm["duree"] ; ?> mins</p>
                <p><?php echo $inffilm["annee"]  ?></p>
                <a class="info_film2" href="/sql-cinema/index.php?action=infoRealisateur&id=<?php echo $inffilm["id_realisateur"] ?>">
                un film de : <?php echo $inffilm["prenom_realisateur"]." ".$inffilm["nom_realisateur"]  ?></a> 
                <div class="genres_film">
                    <?php 
                        foreach ($genres as $genre){
                        $genre_info=explode(':',$genre);
                        $genre_id = $genre_info[0];
                        $genre_nom = $genre_info[1];
                        ?> <a class="info_film2" href="/sql-cinema/index.php?action=infoGenre&id=<?php echo $genre_id ?>"><?php echo $genre_nom. "&nbsp &nbsp" ?> </a>
                    <?php } ?> 
                </div>
                <a class="delele_button"href="/sql-cinema/index.php?action=DeleteFilm&id=<?= $inffilm["id_film"] ?>"> Effacer ce film </a>
           </div>
          
        </div>
        
        
        <div class="synopsis_casting">
            <button class="btn_synopsis actif">Synopsis</button>
            <button class="btn_casting inactif">Casting</button>
            <div class="red_line left1"></div>
        </div>

        <div class="synopsis_container">
             
            <p class="casting_synopsis_p synopsis"> <?= $inffilm["synopsis"] ?> </p>
        </div>

        <div class="casting_synopsis_p casting">

            <?php foreach ($requete2->fetchAll() as $infActeur) { ?>
                <p>
                    <a class="info_film2" href="/sql-cinema/index.php?action=infoActeur&id= <?php echo $infActeur["id_acteur"] ?>"> 
                        <?php 
                        echo $infActeur["prenom_acteur"]." ".$infActeur["nom_acteur"] ?> </a>
                        incarne le personnage de  
                        <a class="info_film2" href="/sql-cinema/index.php?action=infoRole&id= <?php echo $infActeur["id_role"] ?>"><?php 
                        echo $infActeur["nom_role"] 
                        ?>
                    </a> 
                </p>
            <?php } ?>
        </div>
</main>

<script>
        const btn_synopsis = document.querySelector(".btn_synopsis");
        const btn_casting = document.querySelector(".btn_casting");
        const synopsis = document.querySelector(".synopsis");
        const casting = document.querySelector(".casting");
        const redLine = document.querySelector(".red_line");

        btn_synopsis.addEventListener("click", function() {
            if (btn_casting.classList.contains("actif")) {
                btn_casting.classList.remove("actif");
                btn_casting.classList.add("inactif");
                casting.style.display = "none";

                btn_synopsis.classList.remove("inactif");
                btn_synopsis.classList.add("actif");
                synopsis.style.display = "block";
                redLine.classList.remove("right1");
                redLine.classList.add("left1");
            }
        });

        btn_casting.addEventListener("click", function() {
            if (btn_synopsis.classList.contains("actif")) {
                btn_synopsis.classList.remove("actif");
                btn_synopsis.classList.add("inactif");
                synopsis.style.display = "none";

                btn_casting.classList.remove("inactif");
                btn_casting.classList.add("actif");
                casting.style.display = "block";
                redLine.classList.remove("left1");
                redLine.classList.add("right1");
            }
        });
    </script>

<?php
$title="Information du film";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');