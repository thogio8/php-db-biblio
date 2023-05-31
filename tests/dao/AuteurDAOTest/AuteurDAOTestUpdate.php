<?php

require_once "./src/modele/dao/AuteurDAO.php";

$auteurDAO = new AuteurDAO();

$auteur = $auteurDAO->findById(3);
$auteur->setPrenom("Lucas");
$auteur->setNom("Bleau");

$auteurDAO->update($auteur);