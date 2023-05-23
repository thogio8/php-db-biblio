<?php

require_once "./src/modele/dao/LivreDAO.php";

class AfficherLivres{
    private LivreDAO $livreDAO;

    public function __construct()
    {
        $this->livreDAO = new LivreDAO();
    }

    //Méthode qui va permettre d'exécuter la fonctionnalité (use case)
    /**
     * @return Livre[]
     */
    public function execute() : array{
        return $this->livreDAO->findAll();
    }
}