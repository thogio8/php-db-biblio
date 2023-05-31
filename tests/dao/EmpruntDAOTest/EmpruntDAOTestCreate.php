<?php

require_once "./src/modele/dao/EmpruntDAO.php";
require_once "./src/modele/dao/LivreDAO.php";
require_once "./src/modele/dao/UtilisateurDAO.php";

$empruntDAO = new EmpruntDAO();

$livreDAO = new LivreDAO();
$livre = $livreDAO->findByIsbn("145-74-716");

$utilisateurDAO = new UtilisateurDAO();
$utilisateur = $utilisateurDAO->findById(2);

$emprunt = new Emprunt();
$emprunt->setDateEmprunt(new DateTime());
$emprunt->setDateRetour(DateTime::createFromFormat("d/m/Y", "31/07/2023"));
$emprunt->setUtilisateur($utilisateur);
$emprunt->setLivre($livre);

$empruntDAO->create($emprunt);