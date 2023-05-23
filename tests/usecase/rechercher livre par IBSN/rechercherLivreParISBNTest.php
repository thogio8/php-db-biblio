<?php

require_once "./src/modele/usecase/rechercher livre par ISBN/RechercherLivreParISBN.php";

$rechercherLivreParISBN = new RechercherLivreParISBN();

$isbn = "145-74-718";

$livre = $rechercherLivreParISBN->execute($isbn);

if($livre == null){
    echo "Le livre n'existe pas.";
} else {
    echo "ISBN : {$livre->getIsbn()} \t Titre : {$livre->getTitre()} \t Auteur : {$livre->getAuteur()->getNom()} {$livre->getAuteur()->getPrenom()} \t Nombre de pages : {$livre->getNbPages()} \n";
}