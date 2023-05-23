<?php

require_once "./src/modele/dao/LivreDAO.php";

$livreDAO = new LivreDAO();

$livre = $livreDAO->findByIsbn("148-63-956");
if($livre != null){
    echo  $livre->getIsbn() . " " .
        $livre->getTitre()." ".
        $livre->getDateParution()->format("d/m/Y")." " .
        $livre->getNbPages()." ".
        $livre->getAuteur()->getIdAuteur()." ".
        $livre->getAuteur()->getPrenom()." " .
        $livre->getAuteur()->getNom();
}else{
    echo "Le livre n'existe pas.";
}