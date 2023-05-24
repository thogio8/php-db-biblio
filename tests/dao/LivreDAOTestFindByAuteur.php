<?php

require_once "./src/modele/dao/LivreDAO.php";

$livreDAO = new LivreDAO();

$livres = $livreDAO->findByAuteur("Maire");
if($livres != null){
     foreach ($livres as $livre){
         echo  "ISBN : ".$livre->getIsbn()."\t" .
             "Titre : ".$livre->getTitre()."\t".
             "Date de parution : ".$livre->getDateParution()->format("d/m/Y")."\t" .
             "Nombre de pages : ".$livre->getNbPages()."\t".
             "ID auteur : ".$livre->getAuteur()->getIdAuteur()."\t".
             "Prenom auteur : ".$livre->getAuteur()->getPrenom()."\t" .
             "Nom auteur : ".$livre->getAuteur()->getNom().PHP_EOL;
     }
}else{
    echo "Cet auteur n'a pas de livre dans notre bibliothèque.";
}