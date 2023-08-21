<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;1,100;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/a0cb91d4d8.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/sql-cinema/public/css/index.css">
    <script src="/sql-cinema/public/js/index.js" defer></script>
</head>

<body>
    <header>
        <img id="logo" src="/sql-cinema/public/img/logo1.png" alt="logo">
        <div class="nav_links_desktop_visible">
                <li><a class="navbar_component" title="page d'accueil" href="/sql-cinema/index.php?action=FilmsHomePage"><i class="fa-solid fa-house"></i>ACCUEIL</a></li>
                <li><a class="navbar_component" title="liste des films" href="/sql-cinema/index.php?action=ListeFilms"><i class="fa-solid fa-film"></i> FILMS</a></li>
                <li><a class="navbar_component" title="liste des realisateurs" href="/sql-cinema/index.php?action=ListeRealisateurs"><i class="fa-solid fa-user-pen"></i>REALISATEURS</a></li>
                <li><a class="navbar_component" title="liste des acteurs" href="/sql-cinema/index.php?action=ListeActeurs"><i class="fa-solid fa-people-group"></i>ACTEURS</a></li>
                <li><a class="navbar_component" title="liste des roles" href="/sql-cinema/index.php?action=ListeRoles"><i class="fa-solid fa-mask"></i>ROLES</a></li>
                <li><a class="navbar_component" title="liste des genres" href="/sql-cinema/index.php?action=ListeGenres"><i class="fa-solid fa-clapperboard"></i>GENRES</a></li>
            </div>
        <button id="burger_btn" class="normal"><i class="fa-solid fa-arrow-left"></i></button>
    </header>
    <nav id="burger-menu" class="initial">
        <ul id="burger_links"> 
            <div class="nav_links_desktop_hidden">
                <li><a class="navbar_component" title="page d'accueil" href="/sql-cinema/index.php?action=FilmsHomePage"><i class="fa-solid fa-house"></i>Accueil</a></li>
                <li><a class="navbar_component" title="liste des films" href="/sql-cinema/index.php?action=ListeFilms"><i class="fa-solid fa-film"></i> Liste des Films</a></li>
                <li><a class="navbar_component" title="liste des realisateurs" href="/sql-cinema/index.php?action=ListeRealisateurs"><i class="fa-solid fa-user-pen"></i>Liste des Realistaeur</a></li>
                <li><a class="navbar_component" title="liste des acteurs" href="/sql-cinema/index.php?action=ListeActeurs"><i class="fa-solid fa-people-group"></i>Liste des Acteurs</a></li>
                <li><a class="navbar_component" title="liste des roles" href="/sql-cinema/index.php?action=ListeRoles"><i class="fa-solid fa-mask"></i>Liste des Roles</a></li>
                <li><a class="navbar_component" title="liste des genres" href="/sql-cinema/index.php?action=ListeGenres"><i class="fa-solid fa-clapperboard"></i>Liste des Genres</a></li>
            </div>
            <li><a class="navbar_component" titre="Ajouter un Film" href="/sql-cinema/index.php?action=NvFilm_Liste_RealisateurGenres"><i class="fa-solid fa-film"></i>Ajouer un Film</a></li>
            <li><a class="navbar_component" titre="Ajouter un Réalisateur" href="/sql-cinema/view/NewRealisateur.php"><i class="fa-solid fa-user-pen"></i>Ajouter un Realisateur</a></li>
            <li><a class="navbar_component" titre="Ajouter un Acteur" href="/sql-cinema/index.php?action=NvActeur_Liste_FilmRole"><i class="fa-solid fa-people-group"></i>Ajouter un Acteur</a></li>
            <li><a class="navbar_component" titre="Ajouter un Role" href="/sql-cinema/index.php?action=NvRole_Liste_FilmActeur"><i class="fa-solid fa-mask"></i>Ajouter un Role</a></li>
            <li><a class="navbar_component" titre="Ajouter un Genre" href="/sql-cinema/index.php?action=NvGenre_Liste_Film"><i class="fa-solid fa-clapperboard"></i>Ajouter un Genre</a></li>
        </ul>
    </nav>
    <div class="overlay"></div>

    <script>
        document.getElementById("burger_btn").addEventListener("click", function(event) {
        event.stopPropagation();
        const overlay = document.querySelector(".overlay");
        var burgerMenu = document.getElementById("burger-menu");
        if(document.getElementById("burger-menu").classList.contains("initial")) {
        burgerMenu.classList.toggle("open");
        burgerMenu.classList.remove("initial");
        document.getElementById("burger_btn").classList.toggle("right");
        document.getElementById("burger_btn").classList.remove("normal");
        overlay.classList.add("active-overlay");
        }
        else if (document.getElementById("burger-menu").classList.contains("open")) {
        burgerMenu.classList.remove("open");
        burgerMenu.classList.add("close");
        document.getElementById("burger_btn").classList.remove("right");
        document.getElementById("burger_btn").classList.add("left");
        overlay.classList.remove("active-overlay");
        }
        else{
        burgerMenu.classList.remove("close");
        burgerMenu.classList.add("open");
        document.getElementById("burger_btn").classList.remove("left");
        document.getElementById("burger_btn").classList.add("right");
        overlay.classList.add("active-overlay");
        }
        overlay.addEventListener("click", () => {
            burgerMenu.classList.remove("open");
        burgerMenu.classList.add("close");
      overlay.classList.remove("active-overlay");
    });
        });
    </script>

    <h2 class="second_titre"><?=$titre_secondaire ?> </h2>

    <?= $contenu ?>

    <footer>
        <div id="footer_logo_presentation">
            <img id="logo" src="/sql-cinema/public/img/logo1.png" alt="logo">
            <p>Lorem ipsum dolor sit amet, consect etur adi pisicing elit sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit sed do elit.</p>
        </div>
        <div id="footer_links">
            <div class="footer_div">
                <h4>EXPLORER</h4>
            
                <ul>
                    <li><a title="liste des films" href="/sql-cinema/index.php?action=ListeFilms">Films</a></li>
                    <li><a title="liste des realisateurs" href="/sql-cinema/index.php?action=ListeRealisateurs">Realistaeur</a></li>
                    <li><a title="liste des acteurs" href="/sql-cinema/index.php?action=ListeActeurs">Acteurs</a></li>
                    <li><a title="liste des roles" href="/sql-cinema/index.php?action=ListeRoles">Roles</a></li>
                    <li><a title="liste des genres" href="/sql-cinema/index.php?action=ListeGenres">Genres</a></li>
                </ul>
            </div>
            <div class="footer_line"></div>
            

            <div class="footer_div">
                <h4>AJOUTER</h4>
                <ul>
                    <li><a titre="Ajouter un Film" href="/sql-cinema/index.php?action=NvFilm_Liste_RealisateurGenres">Film</a></li>
                    <li><a titre="Ajouter un Réalisateur" href="/sql-cinema/view/NewRealisateur.php">Realisateur</a></li>
                    <li><a titre="Ajouter un Acteur" href="/sql-cinema/index.php?action=NvActeur_Liste_FilmRole">Acteur</a></li>
                    <li><a titre="Ajouter un Role" href="/sql-cinema/index.php?action=NvRole_Liste_FilmActeur">Role</a></li>
                    <li><a titre="Ajouter un Genre" href="/sql-cinema/index.php?action=NvGenre_Liste_Film">Genre</a></li>
                    
                </ul>
            </div>

            
        
            </div>
            
            <div class="contact">
                <h4>CONTACT</h4>
                <ul>
                    <li>66 Brooklyn Street, NYUnited States</li>
                    <li>0 775 554 499</li>
                    <li>Help@Entreprise.com</li>
                </ul>
            </div>
        
            
    </footer>
    
</body>
</html>