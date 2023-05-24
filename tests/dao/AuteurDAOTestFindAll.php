<?php

require_once "./src/modele/dao/AuteurDAO.php";

$auteurDAO = new AuteurDAO();
//Récupérer la liste des auteurs
$auteurs = $auteurDAO->findAll();

foreach ($auteurs as $auteur){
    echo $auteur->getPrenom() . " " .$auteur->getNom().PHP_EOL;
}
