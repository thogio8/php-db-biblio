<?php

require_once "./src/modele/entites/Utilisateur.php";
require_once "./src/modele/config/Database.php";

class UtilisateurDAO{
    public function findById(int $id) : ?Utilisateur{
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT * FROM utilisateur WHERE idUtilisateur = :id";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":id", $id);
        $requete->execute();
        $utilisateurDB = $requete->fetch(PDO::FETCH_ASSOC);
        if($utilisateurDB === false){
            return null;
        }
        return $this->toObject($utilisateurDB);
    }

    /**
     * @param mixed $utilisateurDB
     * @return Utilisateur
     */
    private function toObject(mixed $utilisateurDB): Utilisateur
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setId($utilisateurDB["idUtilisateur"]);
        $utilisateur->setNom($utilisateurDB["nomUtilisateur"]);
        $utilisateur->setPrenom($utilisateurDB["prenomUtilisateur"]);
        return $utilisateur;
    }
}