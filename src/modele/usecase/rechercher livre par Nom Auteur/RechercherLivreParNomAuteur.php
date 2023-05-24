<?php

require_once "./src/modele/dao/LivreDAO.php";

class RechercherLivreParNomAuteur{
    private LivreDAO $livreDAO;

    public function __construct(){
        $this->livreDAO = new LivreDAO();
    }

    public function execute(string $nom) : ?array{
        return $this->livreDAO->findByAuteur($nom);
    }
}