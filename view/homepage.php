<?php 
ob_start();

$film=$requete->fetchAll();
?>
<main> 
<!-- Slideshow container -->
  <div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
      <div class="numbertext">1 / 3</div>
      <a href="index.php?action=infoFilm&id=22"><img src="/sql-cinema/public/img/joker.png" style="width:100%"></a>
      <div class="info_panorama">
          <a href="index.php?action=infoFilm&id=22">THE JOKER 2019</a>
          <P class="date_duree_genre_panorama">2019 | 140 Min | ACTION / DRAMA</P>
          <p class="synopsis_panorama">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum voluptatibus 
            ducimus reprehenderit harum, libero quia quam </p>
            <a href="index.php?action=infoFilm&id=22"><button><i class="fa-solid fa-play"></i> Learn more</button></a>
      </div>
      <div class="text">Joker 2019</div>
      
      
    </div>

    <div class="mySlides fade">
      <div class="numbertext">2 / 3</div>
      <a href="index.php?action=infoFilm&id=1"><img src="/sql-cinema/public/img/oppenheimerHozitontal.jpg" style="width:100%"></a>
      <div class="info_panorama">
          <a href="index.php?action=infoFilm&id=22">OPPENHEIMER 2023</a>
          <P class="date_duree_genre_panorama">2019 | 140 Min | ACTION / DRAMA</P>
          <p class="synopsis_panorama">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum voluptatibus 
            ducimus reprehenderit harum, libero quia quam </p>
            <a href="index.php?action=infoFilm&id=1"><button><i class="fa-solid fa-play"></i> Learn more</button></a>
      </div>
      <div class="text">Oppenheimer 2023</div>
      
    </div>

    <div class="mySlides fade">
      <div class="numbertext">3 / 3</div>
      <a href="index.php?action=infoFilm&id=2"><img src="/sql-cinema/public/img/barbieHorizontal.avif" style="width:100%"></a>
      
      <div class="info_panorama">
          <a href="index.php?action=infoFilm&id=22">BARBIE 2023</a>
          <P class="date_duree_genre_panorama">2019 | 140 Min | ACTION / DRAMA</P>
          <p class="synopsis_panorama">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum voluptatibus 
            ducimus reprehenderit harum, libero quia quam </p>
           <a href="index.php?action=infoFilm&id=2"><button><i class="fa-solid fa-play"></i> Learn more</button></a>
      </div>
      <div class="text">Barbie 2023</div>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <!-- The dots/circles -->
    <div class="carousel_btn"style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>
  </div>
  <br>

  


  <!-- second carousel  -->
  <h2 class="soustitre_homepage">Derniers Sorties</h2>
  <div class="containerCaousel2">
      <div class="wrapper">
        <i id="left" class="fa-solid fa-angle-left"> </i>
          <div class="carousel2">
              <?php foreach($film as $element){ ?> 
                  <a href="index.php?action=infoFilm&id=<?= $element['id_film'] ?>"><img src="<?=$element['affiche']?>" alt="affiche de <?=$element['titre_film']?>" draggable="false"></a>
              <?php } ?>
          </div>
        <i id="right" class="fa-solid fa-angle-right"> </i>
      </div>
  </div>

  <h2 class="soustitre2_homepage">Genres Populaires</h2>


  <div class="genres_populaires">
      <?php foreach($requete2->fetchAll() as $genre) { ?>
      <a href="/sql-cinema/index.php?action=infoGenre&id=<?php echo $genre["id_genre"] ?>"><?= $genre["libelle"] ?></a>
      <?php } ?> 
  </div>

</main>

<?php
$title="Accueil";
$titre_secondaire="";
$contenu = ob_get_clean();
require_once('template.php');