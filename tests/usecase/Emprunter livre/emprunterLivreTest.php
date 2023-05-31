<?php

require_once "./src/modele/usecase/Emprunter livre/EmprunterLivre.php";
require_once "./src/modele/usecase/Emprunter livre/EmprunterLivreRequete.php";
require_once "./src/modele/usecase/Emprunter livre/EmprunterLivreReponse.php";
require_once "./src/modele/usecase/Emprunter livre/EmprunterLivreStatut.php";

$emprunterLivre = new EmprunterLivre();
$requete = new EmprunterLivreRequete("2-11-1111", 2);


$reponse = $emprunterLivre->execute($requete);
$reponse->message;