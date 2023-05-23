<?php

require_once "./src/modele/dao/LivreDAO.php";

$livreDAO = new LivreDAO();

$livre = $livreDAO->findByAuteur("Maire");
if($livre != null){
    echo  $livre->getIsbn() . " " .
        $livre->getTitre()." ".
        $livre->getDateParution()->format("d/m/Y")." " .
        $livre->getNbPages()." Pages ".
        $livre->getAuteur()->getIdAuteur()." ".
        $livre->getAuteur()->getPrenom()." " .
        $livre->getAuteur()->getNom();
}else{
    echo "Cet auteur n'a pas de livre dans notre bibliothèque.";
}