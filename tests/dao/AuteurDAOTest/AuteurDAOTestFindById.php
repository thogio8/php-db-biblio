<?php

require_once "./src/modele/dao/AuteurDAO.php";

$auteurDAO = new AuteurDAO();

$auteur = $auteurDAO->findById(2);
if($auteur != null) {
    echo $auteur->getPrenom() . " AuteurDAOTestFindById.php" . $auteur->getNom();
}else{
    echo "L'auteur n'existe pas";
}