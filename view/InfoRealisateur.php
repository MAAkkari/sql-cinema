<?php session_start();
    ob_start();
    $infRealisateur=$requete->fetchall() ;
?>
    <main> 
        <div id="parallax_bloc" class="parallax_realisateur" >
            <div id="parallax_background"></div>
            <div id="TextAndBtn_parallax">

            <?php if (count($infRealisateur) > 0) { ?>



                <div class="titre_page"><h2 class="font-size-header-info-acteur-mobile"> <?= $infRealisateur[0]["prenom_realisateur"]." ".$infRealisateur[0]["nom_realisateur"]  ?> </h2><h2 class="point_rouge" >.</h2></div>
                <p style="margin-top:-27px;">TOUTES LES INFORMATIONS ! </p>
            </div>
        </div>

        <div class="details_and_picture">
            <img src= " <?=$infRealisateur[0]["photo"]?> " alt="picture of <?= $infRealisateur[0]["prenom_realisateur"]." ".$infRealisateur[0]["nom_realisateur"]  ?>">
            <div class="details_film">
                <div class="titre_note"> 
                    <h3> <?= $infRealisateur[0]["prenom_realisateur"]." ".$infRealisateur[0]["nom_realisateur"]  ?></h3> 
                </div>
                <p>Néé le :<?php echo $infRealisateur[0]["naissance_realisateur"]  ?></p>
                <p>Age : <?php echo $infRealisateur[0]["age_realisateur"]  ?> Ans </p>
            </div> 
           
                
               
           </div>
          style
        </div>
        
          

             <!-- second carousel  -->
  <h2 class="soustitre_homepage"><br><?= $infRealisateur[0]["prenom_realisateur"]." ".$infRealisateur[0]["nom_realisateur"]  ?> a Réaliser </h2>
  <div class="containerCaousel2">
      <div class="wrapper wrapper_realisateur">
        <i id="left" class="fa-solid fa-angle-left"> </i>
          <div class="carousel2" >
              <?php foreach ($infRealisateur as $realisateur) {?>
                <a  href="/sql-cinema/index.php?action=infoFilm&id=<?= $realisateur["id_film"] ?>"> <img  style=" width : 95% !important; height : 300px !important;" class="img_film_acteur" src=" <?= $realisateur["affiche"] ?> "> </a>
                
              <?php } ?>
          </div>
        <i id="right" class="fa-solid fa-angle-right"> </i>
      </div>
  </div>
  <?php }  
            else { echo "Ce Realisateur n'a realisé aucun film, crée un film et ajouter le !";}?> 
<script>

    const carousel2 = document.querySelector(".carousel2");
    firstImg=carousel2.querySelectorAll("img")[0];
    const arrowIcons = document.querySelectorAll(".wrapper i");


    let isDragStart = false, prevPageX, prevScrollLeft ;
    let firstImgWidth =firstImg.clientWidth + 10; 

    arrowIcons.forEach(icon => {
        icon.addEventListener("click", () =>{
            carousel2.scrollLeft +=icon.id=="left" ? -firstImgWidth : firstImgWidth ; 
        } );
    });

    const dragStart = (e) => {
        isDragStart = true ;
        prevPageX = e.pageX || e.touches[0].pageX;
        prevScrollLeft = carousel2.scrollLeft; // Changed 'carousel' to 'carousel2'
    }

    const dragging = (e) => {
        if (!isDragStart) return;
        e.preventDefault();
        let positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX; // Removed unnecessary semicolon
        carousel2.scrollLeft = prevScrollLeft - positionDiff; // Changed 'carousel' to 'carousel2'
    }

    const dragStop = () => {
    isDragStart = false;
    }
    carousel2.addEventListener("mousedown", dragStart);
    carousel2.addEventListener("touchstart", dragStart);



    carousel2.addEventListener("mousemove", dragging);
    carousel2.addEventListener("touchmove", dragging);



    carousel2.addEventListener("mouseup", dragStop);
    carousel2.addEventListener("mouseleave", dragStop);
    carousel2.addEventListener("touchend", dragStop);

</script>









































      
<?php 
$title="Information du réalisateur";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');



