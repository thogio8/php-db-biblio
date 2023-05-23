<?php

require_once "./src/modele/dao/AuteurDAO.php";

$auteurDAO = new AuteurDAO();

$auteur = new Auteur();
$auteur->setPrenom("Olivier");
$auteur->setNom("Gioana");

$auteurDAO->create($auteur);
