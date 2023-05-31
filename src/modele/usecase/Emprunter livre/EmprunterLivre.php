<?php

require_once "./src/modele/dao/LivreDAO.php";
require_once "./src/modele/dao/UtilisateurDAO.php";
require_once "./src/modele/dao/EmpruntDAO.php";
require_once "./src/modele/entites/Livre.php";
require_once "./src/modele/entites/Utilisateur.php";
require_once "./src/modele/entites/Emprunt.php";
require_once "./src/modele/usecase/Emprunter livre/EmprunterLivreReponse.php";
require_once "./src/modele/usecase/Emprunter livre/EmprunterLivreStatut.php";
require_once "./src/modele/usecase/Emprunter livre/EmprunterLivreRequete.php";

class EmprunterLivre{
    private LivreDAO $livreDAO;
    private UtilisateurDAO $utilisateurDAO;
    private EmpruntDAO $empruntDAO;

    public function __construct(){
        $this->livreDAO = new LivreDAO();
        $this->utilisateurDAO = new UtilisateurDAO();
        $this->empruntDAO = new EmpruntDAO();
    }

    public function execute(EmprunterLivreRequete $requete) : EmprunterLivreReponse{
        // 1. Vérifier si le livre existe
        $livre = $this->livreDAO->findByIsbn($requete->isbn);
        if($livre == null){
            return new EmprunterLivreReponse(EmprunterLivreStatut::LIVRE_INEXISTANT, "Le livre n'existe pas.");
        }

        // 2. Vérifier si l'utilisateur existe
        $utilisateur = $this->utilisateurDAO->findById($requete->idUtilisateur);
        if($utilisateur == null){
            return new EmprunterLivreReponse(EmprunterLivreStatut::UTILISATEUR_INEXISTANT, "L'utilisateur n'existe pas.");
        }

        // 3. Vérifier si le livre n'est pas déjà emprunté
        $emprunts = $this->empruntDAO->findByIsbn($requete->isbn);
        foreach($emprunts as $emprunt){
            if($emprunt->getDateRetour() == null){
                return new EmprunterLivreReponse(EmprunterLivreStatut::LIVRE_DEJA_EMPRUNTE, "Le livre est déjà emprunté.");
            }
        }

        // 4. Créer l'emprunt
        $emprunt = new Emprunt();
        $emprunt->setLivre($livre);
        $emprunt->setUtilisateur($utilisateur);
        $emprunt->setDateEmprunt(new DateTime());

        // Insérer dans la base de données
        $this->empruntDAO->create($emprunt);
        return new EmprunterLivreReponse(EmprunterLivreStatut::OK, "OK.");
    }
}