<?php

require_once "./src/modele/entites/Auteur.php";
require_once "./src/modele/config/Database.php";

// Cette classe va permettre de faire du CRUD
// et du mapping Objet-Relationnel
class AuteurDAO {
    // Methode permettant de récupérer l'ensemble des auteurs
    /**
     * @return Auteur[]
     */
    public function findAll(): array {
        //Connexion à la BD
        $connexion = Database::getConnection();
        //Exécuter le SELECT (rechercher les enregistrements)
        $requeteSQL = "SELECT * FROM auteur";
        $requete = $connexion->prepare($requeteSQL);
        $requete->execute();
        $auteursDB = $requete->fetchAll(PDO::FETCH_ASSOC);
        //Mapper les enregistrements vers des objets
        $auteurs = [];
        foreach ($auteursDB as $auteurDB){
            // Création d'un objet Auteur
            $auteur = $this->toObject($auteurDB);
            $auteurs[] = $auteur;
        }
        //Retourner le résultat
        return $auteurs;
    }

    public function findById(int $id) : ?Auteur{
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT * FROM auteur WHERE idAuteur = :id";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":id", $id);
        $requete->execute();
        $auteurDB = $requete->fetch(PDO::FETCH_ASSOC);
        if($auteurDB === false){
            return null;
        }
        return $this->toObject($auteurDB);
    }

    //Methode permettant de créer un nouvel auteur dans la DB
    public function create(Auteur $auteur) : void{
        $connexion = Database::getConnection();
        $requeteSQL = "INSERT INTO auteur(prenomAuteur, nomAuteur) VALUES (:prenom, :nom)";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":prenom", $auteur->getPrenom());
        $requete->bindValue(":nom", $auteur->getNom());
        $requete->execute();
    }

    //Methode permettant de supprimer un auteur dans la DB
    public function delete(int $id) : void{
        $connexion = Database::getConnection();
        $requeteSQL = "DELETE FROM auteur WHERE idAuteur = :id";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":id", $id);
        $requete->execute();
    }

    //Methode permettant de modifier un auteur dans la DB
    public function update(Auteur $auteur) : void{
        $connexion = Database::getConnection();
        $requeteSQL = "UPDATE auteur SET prenomAuteur = :prenom, nomAuteur = :nom WHERE idAuteur = :id";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":prenom", $auteur->getPrenom());
        $requete->bindValue(":nom", $auteur->getNom());
        $requete->bindValue(":id", $auteur->getIdAuteur());
        $requete->execute();
    }

    /**
     * @param mixed $auteurDB
     * @return Auteur
     */
    private function toObject(mixed $auteurDB): Auteur
    {
        $auteur = new Auteur();
        $auteur->setIdAuteur($auteurDB["idAuteur"]);
        $auteur->setNom($auteurDB["nomAuteur"]);
        $auteur->setPrenom($auteurDB["prenomAuteur"]);
        return $auteur;
    }
}
