<?php 

use controller\CinemaController;

spl_autoload_register(function($className){
    include $className . '.php';
});
session_start();
$ctrlCinema = new CinemaController();
// crée un switch qui permet de choisir quelle fonction du controller appeler en fonction de l'action
if (isset($_GET["action"])) {
    switch ($_GET["action"]){
        
        case "ListeFilms" : $ctrlCinema->ListeFilms() ; break;
        case "ListeRealisateurs" : $ctrlCinema->ListeRealisateurs(); break;
        case "ListeActeurs" : $ctrlCinema->ListeActeurs(); break;
        case "ListeRoles" : $ctrlCinema->ListeRoles(); break;
        case "ListeGenres" : $ctrlCinema->ListeGenres(); break;
        case "infoFilm": $ctrlCinema->infoFilm($_GET["id"]);break;
        case "infoRealisateur": $ctrlCinema->infoRealisateur($_GET["id"]);break;
        case "infoActeur": $ctrlCinema->infoActeur($_GET["id"]);break;
        case "infoGenre": $ctrlCinema->infoGenre($_GET["id"]);break;
        case "infoRole": $ctrlCinema->infoRole($_GET["id"]);break;
        case "NvRealisateur": $ctrlCinema->NvRealisateur();break;
        case "NvFilm": $ctrlCinema->NvFilm();break;
        case "NvActeur": $ctrlCinema->NvActeur();break;
        case "NvRole": $ctrlCinema->NvRole();break;
        case "NvRole_Liste_FilmActeur": $ctrlCinema->NvRole_Liste_FilmActeur();break;
        case "NvGenre": $ctrlCinema->NvGenre();break;
        case "NvGenre_Liste_Film":$ctrlCinema->NvGenre_liste_film();break;
        case "NvActeur_Liste_FilmRole":$ctrlCinema->NvActeur_Liste_FilmRole();break;
        case "NvFilm_Liste_RealisateurGenres":$ctrlCinema->NvFilm_Liste_RealisateurGenres();break;
        case "FilmsHomePage":$ctrlCinema->FilmsHomePage();break;
        case "DeleteFilm":$ctrlCinema->DeleteFilm($_GET["id"]);break;
        case "DeleteRole":$ctrlCinema->DeleteRole($_GET["id"]);break;
        case "DeleteGenre":$ctrlCinema->DeleteGenre($_GET["id"]);break;
        case "DeleteActeur":$ctrlCinema->DeleteActeur($_GET["id"]);break;
        case "DeleteRealisateur":$ctrlCinema->DeleteRealisateur($_GET["id"]);break;
    }
} else {
    $ctrlCinema->ListeFilms() ;
}

