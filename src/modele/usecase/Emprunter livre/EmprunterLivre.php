<?php

require_once "./src/modele/dao/LivreDAO.php";
require_once "./src/modele/dao/UtilisateurDAO.php";
require_once "./src/modele/dao/EmpruntDAO.php";
require_once "./src/modele/entites/Livre.php";
require_once "./src/modele/entites/Utilisateur.php";
require_once "./src/modele/entites/Emprunt.php";

class EmprunterLivre{
    private LivreDAO $livreDAO;
    private UtilisateurDAO $utilisateurDAO;
    private EmpruntDAO $empruntDAO;

    public function __construct(){
        $this->livreDAO = new LivreDAO();
        $this->utilisateurDAO = new UtilisateurDAO();
        $this->empruntDAO = new EmpruntDAO();
    }

    public function execute(string $isbn, int $idUtilisateur) : bool{
        // 1. Vérifier si le livre existe
        $livre = $this->livreDAO->findByIsbn($isbn);
        if($livre == null){
            return false;
        }
        // 2. Vérifier si l'utilisateur existe
        $utilisateur = $this->utilisateurDAO->findById($idUtilisateur);
        if($utilisateur == null){
            return false;
        }
        // 3. Créer l'emprunt
        $emprunt = new Emprunt();
        $emprunt->setLivre($livre);
        $emprunt->setUtilisateur($utilisateur);
        $emprunt->setDateEmprunt(new DateTime());

        // Insérer dans la base de données
        $this->empruntDAO->create($emprunt);
        return true;
    }
}