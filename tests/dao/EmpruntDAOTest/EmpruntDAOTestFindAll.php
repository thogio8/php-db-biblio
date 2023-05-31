<?php

require_once "./src/modele/dao/EmpruntDAO.php";

$empruntDAO = new EmpruntDAO();

$emprunts = $empruntDAO->findAll();

foreach ($emprunts as $emprunt) {
    echo $emprunt->getIdEmprunt()."\t".$emprunt->getUtilisateur()->getId()."\t".$emprunt->getLivre()->getIsbn()."\t".$emprunt->getDateEmprunt()->format("Y-m-d");
}