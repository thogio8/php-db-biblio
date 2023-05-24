<?php

require_once "./src/modele/usecase/rechercher livre par Nom Auteur/RechercherLivreParNomAuteur.php";

$rechercherLivreParNomAuteur = new RechercherLivreParNomAuteur();

$nomAuteur = "Maire";

$livres = $rechercherLivreParNomAuteur->execute();