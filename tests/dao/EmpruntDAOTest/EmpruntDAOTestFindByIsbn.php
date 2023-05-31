<?php

require_once "./src/modele/dao/EmpruntDAO.php";

$empruntDAO = new EmpruntDAO();

$emprunts = $empruntDAO->findByIsbn("145-74-716");

foreach($emprunts as $emprunt){
    print_r($emprunt);
}