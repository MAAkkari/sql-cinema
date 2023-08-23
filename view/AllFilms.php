<?php 
    ob_start(); 
    $films = $requete->fetchAll() ; 
?>
<main>



 <div id="parallax_bloc">
            <div id="parallax_background" ></div>
            <div id="TextAndBtn_parallax">
                <div class="titre_page"><h2>FILMS</h2><h2 class="point_rouge">.</h2></div>
                <p>RETROUVER TOUT VOS FILMS PREFERER !</p>
            </div>
        </div>

        <?php  
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){?>     
        <h3 class="message_ajout"><?= $_SESSION["message"][0]   ?></h3>
        
    <?php } 
        $_SESSION["message"]=[];
    ?>

        <!-- second carousel  -->
  <h2 class="soustitre_homepage"><br> Derniers Sorties</h2>
  <div class="containerCaousel2">
      <div class="wrapper">
        <i id="left" class="fa-solid fa-angle-left"> </i>
          <div class="carousel2">
              <?php foreach ( $films as $element) { ?> 
                  <a href="index.php?action=infoFilm&id=<?= $element['id_film'] ?>"><img src="<?=$element['affiche']?>" alt="affiche de <?=$element['titre_film']?>" draggable="false"></a>
              <?php } ?>
          </div>
        <i id="right" class="fa-solid fa-angle-right"> </i>
      </div>
  </div>
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

    document.addEventListener("DOMContentLoaded", function() {
    const elementToDisappear = document.querySelector(".message_ajout");
  
    setTimeout(function() {
      elementToDisappear.classList.add("disappear");
    }, 3000); // 3000 milliseconds (3 seconds) delay
  });
</script>

<h2 class="soustitre_homepage"><br> Tout les Films </h2>
    <div class="liste_films">
        <?php foreach ( $films as $element) { ?> 

            <div class="film_individuel" >
                <div class="img_hover">
                    <a href="index.php?action=infoFilm&id=<?= $element['id_film'] ?>">
                        <img src="<?=$element['affiche']?>" alt="affiche de <?=$element['titre_film']?>">
                    </a>
                        <div class="Blog_Author_Date">
                            <a class="info_film" href="/sql-cinema/index.php?action=infoRealisateur&id=<?= $element["id_auteur"] ?>">De: <?= $element["prenom"]." ".$element["nom"]  ?></a>
                            <p> <?php echo $element["durée_minute"] ; ?> Minutes </p>
                            <p>sortie le : <?php echo $element["année_sortie_fr"]  ?></p>
                        </div>
                    
                </div>
                <a href="index.php?action=infoFilm&id=<?= $element['id_film'] ?>"><?=$element['titre_film']?></a> 
            </div>

        <?php } ?>
    </div>
        

</main>






<?php
$title="Liste des Films";
$titre_secondaire="liste des Films";
$contenu = ob_get_clean();
require_once('template.php');










