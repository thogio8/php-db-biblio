<?php

require_once "./src/modele/usecase/rechercher livre par Nom Auteur/RechercherLivreParNomAuteur.php";

$rechercherLivreParNomAuteur = new RechercherLivreParNomAuteur();

$nomAuteur = "Lamy";

$livres = $rechercherLivreParNomAuteur->execute($nomAuteur);

if($livres == null){
    echo "Cet auteur n'a pas de livre dans notre bibliothèque.";
}else{
    foreach ($livres as $livre){
        echo  "ISBN : ".$livre->getIsbn()."\t" .
            "Titre : ".$livre->getTitre()."\t".
            "Date de parution : ".$livre->getDateParution()->format("d/m/Y")."\t" .
            "Nombre de pages : ".$livre->getNbPages()."\t".
            "ID auteur : ".$livre->getAuteur()->getIdAuteur()."\t".
            "Prenom auteur : ".$livre->getAuteur()->getPrenom()."\t" .
            "Nom auteur : ".$livre->getAuteur()->getNom().PHP_EOL;
    }
}