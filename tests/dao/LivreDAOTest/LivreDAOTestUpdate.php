<?php

require_once "./src/modele/dao/LivreDAO.php";

$livreDAO = new LivreDAO();

$livre = $livreDAO->findByIsbn("147-74-719");
$livre->setTitre("Livre4");
$livre->setNbPages(180);
$livre->getAuteur()->setIdAuteur(2);

$livreDAO->update($livre);