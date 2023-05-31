<?php

require_once "./src/modele/dao/LivreDAO.php";

$livreDAO = new LivreDAO();

$livre = $livreDAO->findByIsbn("148-63-956");
if($livre != null){
    echo  "ISBN : ".$livre->getIsbn() . " " .
        "Titre : ".$livre->getTitre()." ".
        "Date de parution : ".$livre->getDateParution()->format("d/m/Y")." " .
        "Nombre de pages : ".$livre->getNbPages()." ".
        "ID auteur : ".$livre->getAuteur()->getIdAuteur()." ".
        "Prenom auteur : ".$livre->getAuteur()->getPrenom()." " .
        "Nom auteur : ".$livre->getAuteur()->getNom().PHP_EOL;
}else{
    echo "Le livre n'existe pas.";
}