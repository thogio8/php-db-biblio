<?php

require_once "./src/modele/dao/LivreDAO.php";

$livreDAO = new LivreDAO();

$livres = $livreDAO->findAll();

foreach ($livres as $livre){
    echo $livre->getIsbn() . " LivreDAOTestFindAll.php" .
        $livre->getTitre()." ".
        $livre->getDateParution()->format("d/m/Y")." " .
        $livre->getNbPages()." ".$livre->getAuteur()->getPrenom()." " .
        $livre->getAuteur()->getNom().
        PHP_EOL;
}