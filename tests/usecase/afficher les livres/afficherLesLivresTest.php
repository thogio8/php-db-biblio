<?php

require_once "./src/modele/usecase/afficher les livres/AfficherLivres.php";

$afficherLivre = new AfficherLivres();

$livres = $afficherLivre->execute();

foreach ($livres as $livre){
    echo "ISBN : {$livre->getIsbn()} \t Titre : {$livre->getTitre()}\t Auteur : {$livre->getAuteur()->getNom()} {$livre->getAuteur()->getPrenom()} \t Nombre de pages : {$livre->getNbPages()} \n";
}