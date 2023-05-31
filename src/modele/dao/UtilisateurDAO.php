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
        $auteurDB = $requete->fetch(PDO::FETCH_ASSOC);
        if($auteurDB === false){
            return null;
        }
        return $this->toObject($auteurDB);
    }
}