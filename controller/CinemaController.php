<?php

namespace Controller; 
use Model\Connect;

//recupere les information de chaque film dans la base de donnée
class CinemaController {
    public function ListeFilms(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT * FROM film 
        INNER JOIN realisateur ON realisateur.id_auteur = film.id_auteur 
        INNER JOIN personne ON personne.id_personne = realisateur.id_personne");
        require "view/AllFilms.php";
    }
    public function FilmsHomePage(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(" SELECT * FROM film 
        INNER JOIN realisateur ON realisateur.id_auteur = film.id_auteur 
        INNER JOIN personne ON personne.id_personne = realisateur.id_personne");
        $requete2 = $pdo->query(" SELECT * FROM genre LIMIT 5 ");
        require "view/homepage.php";
    }

    //recupere les information de chaque realisateur dans la base de donnée
    public function ListeRealisateurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT * FROM personne INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne");
        require "view/AllRealisateurs.php";  
    }

    //recupere les information de chaque acteur dans la base de donnée
    public function ListeActeurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT * FROM personne INNER JOIN acteur ON personne.id_personne = acteur.id_personne");
        require "view/AllActeurs.php";  
    }

    //recupere les information de chaque role dans la base de donnée
    public function ListeRoles(){
        $pdo = connect :: seConnecter(); 
        $requete = $pdo->query("SELECT * FROM role");
        require "view/AllRoles.php";
    }

//recupere les information de chaque genre dans la base de donnée
    public function ListeGenres(){
        $pdo = connect :: seConnecter();
        $requete = $pdo->query("SELECT * FROM genre");
        require "view/AllGenres.php";
    }

//recupere les informations du film , de ses genres , de son realisateur et de ses acteurs
    public function infoFilm($id){
        $pdo = connect :: seConnecter();
        $requete1= $pdo->prepare("SELECT 
        film.id_film,
        film.titre_film AS 'titre', 
        film.année_sortie_fr AS 'annee', 
        film.durée_minute AS 'duree', 
        film.affiche, 
        film.note, 
        film.synopsis,
        film.id_auteur AS 'id_realisateur' ,
        realisateur_personne.nom AS 'nom_realisateur', 
        realisateur_personne.prenom AS 'prenom_realisateur',
        realisateur_personne.sexe AS 'sexe_realisateur',
        realisateur_personne.date_naissance AS 'naissance_realisateur',
        GROUP_CONCAT(DISTINCT CONCAT(genre.id_genre, ':', genre.libelle) SEPARATOR ';') AS 'genres_details'
        FROM film
        INNER JOIN realisateur ON realisateur.id_auteur = film.id_auteur
        INNER JOIN personne AS realisateur_personne ON realisateur_personne.id_personne = realisateur.id_personne
        INNER JOIN appartenir ON appartenir.id_film = film.id_film
        INNER JOIN genre ON genre.id_genre = appartenir.id_genre
        LEFT JOIN jouer ON jouer.id_film = film.id_film
        WHERE film.id_film = :id
        GROUP BY film.id_film");
        
        $requete2 = $pdo->prepare("SELECT film.id_film, acteur_personne.nom AS nom_acteur , acteur_personne.prenom AS prenom_acteur, acteur_personne.sexe AS sexe_acteur 
        , acteur_personne.date_naissance AS acteur_naissance , acteur.id_acteur AS id_acteur , role.Id_role AS id_role , role.nom_role AS nom_role
         FROM film
         INNER JOIN jouer ON jouer.id_film = film.id_film
         INNER JOIN acteur ON acteur.id_acteur = jouer.id_acteur
         INNER JOIN personne AS acteur_personne ON acteur_personne.id_personne = acteur.id_personne
         INNER JOIN role ON role.Id_role = jouer.Id_role
         WHERE film.id_film = :id");
        $requete1->execute(["id"=>$id]);
        $requete2 -> execute(["id"=>$id]);
        require "view/InfoFilm.php";
    }

    //recupere les informations du realisateur et de ses films
    public function infoRealisateur($id){
        $pdo= connect:: seConnecter();
        $requete= $pdo->prepare( "SELECT personne.photo AS 'photo' ,(YEAR(CURRENT_DATE)-YEAR(personne.date_naissance)) AS 'age_realisateur',film.titre_film AS 'titre',film.année_sortie_fr AS 'annee', film.affiche, film.id_film,
        personne.nom AS 'nom_realisateur', personne.prenom AS 'prenom_realisateur',
        personne.sexe AS 'sexe_realisateur',personne.date_naissance AS 'naissance_realisateur' FROM film
        INNER JOIN realisateur ON realisateur.id_auteur = film.id_auteur
        INNER JOIN personne ON personne.id_personne = realisateur.id_personne
        WHERE realisateur.id_auteur = :id");
        $requete->execute(["id"=>$id]);
        require "view/infoRealisateur.php";
    }

    //recupere les informations de l'acteur et de ses films
    public function infoActeur($id){
        $pdo = connect::seConnecter();
        $requete = $pdo-> prepare("SELECT  film.titre_film AS 'titre',film.id_film,film.année_sortie_fr AS 'annee',film.affiche,
        role.nom_role AS 'personnage', acteur_personne.nom AS 'nom_acteur', acteur_personne.prenom AS 'prenom_acteur',
        acteur_personne.sexe AS 'sexe_acteur', acteur_personne.date_naissance AS 'naissance_acteur', role.Id_role,
        acteur_personne.photo,(YEAR(CURRENT_DATE)-YEAR(acteur_personne.date_naissance)) AS 'age_acteur' 
        FROM film
        INNER JOIN jouer ON jouer.id_film = film.id_film
        INNER JOIN acteur ON acteur.id_acteur = jouer.id_acteur
        INNER JOIN role ON role.Id_role = jouer.Id_role
        INNER JOIN personne AS acteur_personne ON acteur_personne.id_personne = acteur.id_personne
        WHERE acteur.id_acteur = :id ");
        $requete->execute(["id"=>$id]);
        require "view/infoActeur.php";
    }

    //recupere les informations du genre et de ses films
    public function infoGenre($id){
        $pdo = connect :: seConnecter();
        $requete = $pdo-> prepare("SELECT * FROM film 
        INNER JOIN realisateur ON realisateur.id_auteur = film.id_auteur 
        INNER JOIN personne ON personne.id_personne = realisateur.id_personne
		INNER JOIN appartenir ON appartenir.id_film = film.id_film
		INNER JOIN genre ON genre.id_genre = appartenir.id_genre
		WHERE genre.id_genre = :id ");
        $requete->execute(["id"=>$id]);
        require_once "view/infoGenre.php";
    }

    //recupere les informations du role et de ses films
    public function infoRole($id){
        $pdo = connect :: seConnecter();
        $requete = $pdo->prepare("SELECT acteur.id_acteur, film.titre_film AS 'titre',film.id_film,film.année_sortie_fr AS 'annee',film.affiche,
        role.nom_role AS 'personnage', acteur_personne.nom AS 'nom_acteur', acteur_personne.prenom AS 'prenom_acteur',
        acteur_personne.sexe AS 'sexe_acteur', acteur_personne.date_naissance AS 'naissance_acteur' FROM film
        INNER JOIN jouer ON jouer.id_film = film.id_film
        INNER JOIN acteur ON acteur.id_acteur = jouer.id_acteur
        INNER JOIN role ON role.Id_role = jouer.Id_role
        INNER JOIN personne AS acteur_personne ON acteur_personne.id_personne = acteur.id_personne
        WHERE role.Id_role = :id");
        $requete -> execute(["id"=>$id]);
        require_once "view/infoRole.php";
    }

    //crée un nouveau realisateur
    public function NvRealisateur(){
        //sanitization des données
        $nom_realisateur = filter_input(INPUT_POST,"name_realisateur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom_realisateur = filter_input(INPUT_POST,"prenom_realisateur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe_realisateur = filter_input(INPUT_POST,"sexe_realisateur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $naissance_realisateur = filter_input(INPUT_POST, "naissance_realisateur",  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // var_dump($_POST);
        // var_dump($sexe_realisateur);

        //sanitization de l'image
        $tmpName = $_FILES["image_realisateur"]["tmp_name"];
        $img_name = $_FILES["image_realisateur"]["name"];
        $size = $_FILES["image_realisateur"]["size"];
        $error = $_FILES["image_realisateur"]["error"];
        $type = $_FILES["image_realisateur"]["type"];

        //verifie que l'image a le bonne extension et la deplace dans le dossier img
        $tabExtension=explode('.',$img_name);
        $extension=strtolower(end($tabExtension));
        $AcceptedExtensions=["jpg","jpeg","gif","png"];
        $imgfile = "public/img/";
        if(in_array($extension,$AcceptedExtensions ) && $error==0 ){
            $uniqueName=uniqid("",true);
            $fileName=$uniqueName.".".$extension;
            move_uploaded_file($tmpName,'public\img/'.$fileName);
        }
        else{ 
            echo "mauvaise extension, taille trop élevé ou erreur ";
        }
        // var_dump($nom_realisateur);
        // var_dump($prenom_realisateur);
        // var_dump($sexe_realisateur);
        // var_dump($naissance_realisateur);
        // var_dump($fileName);
        // var_dump($naissance_realisateur);

        //si les données sont bien rentrées dans le formulaire, les envoies dans la base de donnée
        if($nom_realisateur && $prenom_realisateur && $sexe_realisateur  && $naissance_realisateur &&  $fileName &&  $naissance_realisateur){
            $pdo = connect :: seConnecter();
            $requete1 = $pdo->prepare("INSERT INTO personne (nom , prenom, sexe, date_naissance, photo)
            VALUES ('$nom_realisateur', '$prenom_realisateur', '$sexe_realisateur', '$naissance_realisateur', '$imgfile$fileName')");
            $requete2 = $pdo->prepare("INSERT INTO realisateur (id_personne)
            SELECT personne.id_personne FROM personne WHERE personne.nom = '$nom_realisateur' AND personne.prenom = '$prenom_realisateur'");
            $requete1->execute();
            $requete2->execute();
            header("Location: /sql-cinema/view/NewRealisateur.php");
        }
    }
    //crée un nouveau genre
    public function NvGenre(){
        //sanitize libelle
        $libelle = filter_input(INPUT_POST,"libelle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // var_dump($_POST["films"]);
        //sanitize toutes les cellules de $_POST["films"] 
        if(isset($_POST["films"]) && !empty($_POST["films"])) {
            foreach ($_POST["films"] as $index=>$film ) {
                $film = filter_input(INPUT_POST,"films[$index]", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            // var_dump($_POST["films"]);

            //verification que tout les cellules sont remplis dans $_POST["films"]
            foreach ($_POST["films"] as $film) {
                if (empty($film)) {
                    $TableCheck = false;
                    break; 
                }

                else{ $TableCheck =true ;}
            }
            // var_dump($TableCheck);
        }
        //si libelle et toute les cellules de $_POST["films"] = true , crée le genre et crée les tableau associatif necessaires dans "appartenir"
        if ( $libelle ){
            if ( $TableCheck ){
                $pdo = Connect :: seConnecter();
                $requete1 = $pdo->query("INSERT INTO genre ( libelle ) VALUES ('$libelle') ;");
                foreach($_POST["films"] as $index=>$film){
                    // var_dump($film);
                    $requete2 = $pdo->query( " INSERT INTO appartenir (id_film, id_genre) VALUES (
                        (SELECT id_film FROM film WHERE film.titre_film = '$film'),
                        (SELECT id_genre FROM genre WHERE genre.libelle = '$libelle')) " );
                }
            }
            // si seul le libelle = true crée le genre mais ne crée aucune liaison avec des films dans le tableau associatif "appartenir" 
            else {
                $pdo = Connect :: seConnecter();
                $requete1 = $pdo->query("INSERT INTO genre ( libelle ) VALUES ('$libelle') ;");
            }
        }
    
        header("Location:/sql-cinema/index.php?action=NvGenre_Liste_Film");
    }
    // affiche un <select> avec la liste de tout les films lors de la creation d'un nouveau genre
    public function NvGenre_liste_film(){
            $pdo = connect::seConnecter(); 
            $requete = $pdo->query("SELECT film.titre_film FROM film");
            require "view/NewGenre.php";
        }
    //creation un nouveau role 
    public function NvRole(){
        //sanitize nom_role
        $nom_role = filter_input(INPUT_POST,"nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //sanitize toutes les cellules de $_POST["films_role"] et $_POST["acteurs_role"] (les deux tableaux sont de la meme taille)
        if(isset($_POST["films_role"]) && !empty($_POST["films_role"])) {
            foreach ($_POST["films_role"] as $index=>$film_role ) {
                $film_role = filter_input(INPUT_POST,"films_role[$index]", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            foreach ($_POST["acteurs_role"] as $index=>$acteur_role ) {
                $acteur_role = filter_input(INPUT_POST,"films_role[$index]", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        
        $TableCheckActeur=false;
        $TableCheckFilms=false;
        //verification que tout les cellules sont remplis dans $_POST["films_role"] et $_POST["acteurs_role"]
        foreach ($_POST["films_role"] as $film_role) {
            if (empty($film_role)) {
                $TableCheckFilms = false;
                break; 
            }
            else{ $TableCheckFilms =true ;}
        }
        foreach ($_POST["acteurs_role"] as $acteur_role) {
            if (empty($acteur_role)) {
                $TableCheckActeur = false;
                break; 
            }
            else{ $TableCheckActeur =true ;}
        }
        //si nom_role et toute les cellules de $_POST["films_role"] et $_POST["acteurs_role"] = true , crée le role et crée
        if ( $nom_role ){
            $pdo = Connect :: seConnecter();
            $requete1 = $pdo->query(" INSERT INTO role (nom_role) VALUES ('$nom_role')");
            
            //si les deux tableaux ne sont pas vide , crée les tableau associatif necessaires dans "jouer" sinon le 
            //genre est crée mais ne crée aucune liaison avec des films dans le tableau associatif "jouer"
            if ( $TableCheckFilms && $TableCheckActeur ){ 
                foreach($_POST["films_role"] as $index=>$film){
                $acteur=$_POST["acteurs_role"][$index];
                
                $requete2 = $pdo->query("INSERT INTO jouer (id_film, id_acteur, id_role)
                SELECT
                    (SELECT id_film FROM film WHERE film.titre_film = '$film'),
                    (SELECT id_acteur FROM acteur WHERE acteur.id_personne = 
                        (SELECT id_personne FROM personne WHERE CONCAT(personne.prenom, ' ', personne.nom) = '$acteur')
                    ),
                    (SELECT id_role FROM role WHERE role.nom_role = '$nom_role')");
                }
            }
        }
        header("Location:/sql-cinema/index.php?action=NvRole_Liste_FilmActeur");
    }

    // affiche un <select> avec la liste de tout les films et acteurs lors de la creation d'un nouveau role
    public function NvRole_Liste_FilmActeur(){
        $pdo = connect::seConnecter(); 
            $requete1 = $pdo->query("SELECT film.titre_film FROM film");
            $requete2 = $pdo->query("SELECT CONCAT(personne.prenom,' ',personne.nom ) AS nom_complet FROM personne
            INNER JOIN acteur ON acteur.id_personne = personne.id_personne");
            require "view/NewRole.php";
    }

    // affiche un <select> avec la liste de tout les films et role lors de la creation d'un nouveau acteur
    public function NvActeur_Liste_FilmRole(){
        $pdo = connect::seConnecter(); 
        $requete1 = $pdo->query("SELECT film.titre_film FROM film");
        $requete2 = $pdo->query("SELECT role.nom_role FROM role");
            require "view/NewActeur.php";
    }

    //creation un nouveau acteur
    public function NvActeur(){
        //sanitize nom_acteur , prenom_acteur , sexe_acteur , naissance_acteur
        $nom_acteur = filter_input(INPUT_POST,"name_acteur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom_acteur = filter_input(INPUT_POST,"prenom_acteur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe_acteur = filter_input(INPUT_POST,"sexe_acteur", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $naissance_acteur = filter_input(INPUT_POST, "naissance_acteur",  FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //sanitize de l'image de l'acteur 
        $tmpName = $_FILES["image_acteur"]["tmp_name"];
        $img_name = $_FILES["image_acteur"]["name"];
        $size = $_FILES["image_acteur"]["size"];
        $error = $_FILES["image_acteur"]["error"];
        $type = $_FILES["image_acteur"]["type"];
        
        //verifie que l'image est bien une image et que la taille est inferieur a 2Mo
        $tabExtension=explode('.',$img_name);
        $extension=strtolower(end($tabExtension));
        $AcceptedExtensions=["jpg","jpeg","gif","png"];
        $imgfile = "public/img/";

        //si l'image est bien une image , l'image est upload dans le dossier "public/img"
        if(in_array($extension,$AcceptedExtensions ) && $error==0 ){
            $uniqueName=uniqid("",true);
            $fileName=$uniqueName.".".$extension;
            move_uploaded_file($tmpName,'public\img/'.$fileName);
        }
        else{
            echo "mauvaise extension, taille trop élevé ou erreur ";
        }
        //sanize les deux tableaux $_POST["films_acteur"] et $_POST["roles_acteur"] qui contiennent les films et roles de l'acteur
        if(isset($_POST["films_acteur"]) && !empty($_POST["films_acteur"])) {
            foreach ($_POST["films_acteur"] as $index=>$film_acteur ) {
                $film_acteur = filter_input(INPUT_POST,"films_acteur[$index]", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            foreach ($_POST["roles_acteur"] as $index=>$role_acteur ) {
                $role_acteur = filter_input(INPUT_POST,"roles_acteur[$index]", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        //verifie que les deux tableaux $_POST["films_acteur"] et $_POST["roles_acteur"] ne sont pas vide apres le sanitize
        $TableCheckRole=false;
        $TableCheckFilms=false;
        foreach ($_POST["films_acteur"] as $film_acteur) {
            if (empty($film_acteur)) {
                $TableCheckFilms = false;
                break; 
            }
            else{ $TableCheckFilms =true ;}
        }
        foreach ($_POST["roles_acteur"] as $role_acteur) {
            if (empty($role_acteur)) {
                $TableCheckRole = false;
                break; 
            }
            else{ $TableCheckRole =true ;}
        }
        //verifie que les champs ne sont pas vide apres le sanitize et creation de l'acteur
        if($nom_acteur && $prenom_acteur && $sexe_acteur  && $naissance_acteur &&  $fileName &&  $naissance_acteur){
            $pdo = connect :: seConnecter();
            $requete1 = $pdo->prepare("INSERT INTO personne (nom , prenom, sexe, date_naissance, photo)
            VALUES ('$nom_acteur', '$prenom_acteur', '$sexe_acteur', '$naissance_acteur', '$imgfile$fileName')");
            $requete2 = $pdo->prepare("INSERT INTO acteur (id_personne)
            SELECT personne.id_personne FROM personne WHERE personne.nom = '$nom_acteur' AND personne.prenom = '$prenom_acteur'");
            // var_dump($_POST['roles_acteur']);

            //verifie que les deux tableaux $_POST["films_acteur"] et $_POST["roles_acteur"] , puis rempli la table associatif jouer
            if ( $TableCheckFilms && $TableCheckRole ){
                foreach($_POST["films_acteur"] as $index=>$film){
                $nom_role=$_POST["roles_acteur"][$index];
                // var_dump($_POST['roles_acteur']);
                // var_dump($nom_role);
                $requete3 = $pdo->prepare("INSERT INTO jouer (id_film, id_acteur, id_role)
                SELECT
                    (SELECT id_film FROM film WHERE film.titre_film = '$film'),
                    (SELECT id_acteur FROM acteur WHERE acteur.id_personne = 
                        (SELECT id_personne FROM personne WHERE personne.nom='$nom_acteur' AND personne.prenom='$prenom_acteur')),
                    (SELECT id_role FROM role WHERE role.nom_role = '$nom_role')");

                }
            }
            $requete1->execute();
            $requete2->execute();
            $requete3->execute();
        }
    header("Location:/sql-cinema/index.php?action=NvActeur_Liste_FilmRole");
    }


    //fonction qui affiche la liste des films et des roles pour le formulaire de creation de film
    public function NvFilm_Liste_RealisateurGenres(){
        $pdo = connect::seConnecter(); 
        $requete1 = $pdo->query("SELECT CONCAT(personne.prenom,' ',personne.nom ) AS nom_complet FROM personne
        INNER JOIN realisateur ON realisateur.id_personne = personne.id_personne");
        $requete2 = $pdo->query("SELECT genre.libelle from genre "); 
        require "view/NewFilm.php";
    }

    //creation d'un film
    public function NvFilm(){
        //sanitize des informations
        $titre = filter_input(INPUT_POST,"titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $duree = filter_input(INPUT_POST,"duree", FILTER_VALIDATE_INT);
        $note = filter_input(INPUT_POST,"note", FILTER_VALIDATE_INT);
        $sortie = filter_input(INPUT_POST, "sortie",  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $realisateur = filter_input(INPUT_POST,"realisateur_film", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //sanitize du synopsis si il existe
        if(!isset($_POST["synopsis"])|| empty($_POST["synopsis"])){
            $synopsis = filter_input(INPUT_POST,"synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        else ($synopsis ="");

        //verification extension et erreurs de l'affiche 
        $tmpName = $_FILES["affiche"]["tmp_name"];
        $img_name = $_FILES["affiche"]["name"];
        $size = $_FILES["affiche"]["size"];
        $error = $_FILES["affiche"]["error"];
        $type = $_FILES["affiche"]["type"];

        //verifie que l'affiche est bien une image et qu'il n'y a pas d'erreur puis la deplace dans le dossier img
        $tabExtension=explode('.',$img_name);
        $extension=strtolower(end($tabExtension));
        $AcceptedExtensions=["jpg","jpeg","gif","png"];
        $imgfile = "public/img/";
        if(in_array($extension,$AcceptedExtensions ) && $error==0 ){
            $uniqueName=uniqid("",true);
            $fileName=$uniqueName.".".$extension;
            move_uploaded_file($tmpName,'public/img/'.$fileName);
        }
        else{
            echo "mauvaise extension, taille trop élevé ou erreur ";
        }
        $imgfile = "public/img/";
        //sanitize table des genres du film
        if(isset($_POST["genre_film"]) && !empty($_POST["genre_film"])) {
            foreach ($_POST["genre_film"] as $index=>$genre ) {
                $genre = filter_input(INPUT_POST,"genre_film[$index]", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        //verifie que le tableau des genres n'est pas vide apres le sanitize
        $TableCheckGenres=false;
        foreach ($_POST["genre_film"] as $genre) {
            if (empty($genre)) {
                $TableCheckGenres = false;
                break; 
            }
            else{ $TableCheckGenres =true ;}
        }
        //si tout les champs sont rempli alors on execute la requete d'insertion dans la base de donnée
        if ($titre && $duree && $sortie && $note && $realisateur && $fileName){
            $pdo = connect::seConnecter();
            $requete1 = $pdo->prepare("INSERT INTO film (titre_film, année_sortie_fr, durée_minute, affiche, note, synopsis, id_auteur)
            VALUES ('$titre', '$sortie', $duree, '$imgfile$fileName' ,$note, '$synopsis' ,(SELECT realisateur.id_auteur FROM realisateur WHERE id_personne =
                    (SELECT personne.id_personne FROM personne WHERE 
                       CONCAT(personne.prenom,' ', personne.nom) = '$realisateur')))");
            $requete1->execute();

            //si le tableau des genres n'est pas vide alors on execute on remplis la table associative appartenir avec les genres du film
            foreach($_POST["genre_film"] as $genre){
            $requete2 = $pdo->prepare("INSERT INTO appartenir (id_film, id_genre)
            VALUES ((SELECT film.id_film FROM film WHERE titre_film = '$titre'),(SELECT genre.id_genre FROM genre WHERE libelle = '$genre'))");
            $requete2->execute();
        }
        }
    }
}