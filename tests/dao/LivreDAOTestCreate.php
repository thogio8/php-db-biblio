<?php

require_once "./src/modele/dao/LivreDAO.php";
require_once "./src/modele/dao/AuteurDAO.php";

$livreDAO = new LivreDAO();

$auteurDAO = new AuteurDAO();
$auteur = $auteurDAO->findById(3);

$livre = new Livre();
$livre->setIsbn("747-77-719");
$livre->setTitre("Livre1");
$livre->setDateParution(DateTime::createFromFormat("d/m/Y", "13/02/2022"));
$livre->setNbPages(129);
$livre->setAuteur($auteur);

$livreDAO->create($livre);