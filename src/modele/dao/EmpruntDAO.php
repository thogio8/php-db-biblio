<?php

require_once "./src/modele/entites/Emprunt.php";
require_once "./src/modele/config/Database.php";

class EmpruntDAO
{
    /**
     * @return Livre[]
     */
    public function findAll(): array
    {
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT * FROM emprunt";
        $requete = $connexion->prepare($requeteSQL);
        $requete->execute();
        $empruntsDB = $requete->fetchAll(PDO::FETCH_ASSOC);
        $emprunts = [];
        foreach ($empruntsDB as $empruntDB) {
            // Création d'un objet Auteur
            $emprunt = $this->toObject($empruntDB);
            $emprunts[] = $emprunt;
        }
        //Retourner le résultat
        return $emprunts;
    }

    public function findByIsbn(string $isbn): ?Emprunt
    {
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT * FROM emprunt WHERE isbn = :isbn";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":isbn", $isbn);
        $requete->execute();
        $empruntDB = $requete->fetch(PDO::FETCH_ASSOC);
        if ($empruntDB === false) {
            return null;
        }
        return $this->toObject($empruntDB);
    }

    public function findByUtilisateur(string $nomUtilisateur): ?array
    {
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT u.*, e.* FROM emprunt e INNER JOIN utilisateur u on e.idUtilisateur = u.idUtilisateur WHERE u.nomUtilisateur LIKE CONCAT('%',:nomUtilisateur,'%')";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":nomAuteur", $nomUtilisateur);
        $requete->execute();
        $empruntsDB = $requete->fetchAll(PDO::FETCH_ASSOC);
        if ($empruntsDB === false) {
            return null;
        }
        $emprunts = [];
        foreach ($empruntsDB as $empruntDB) {
            $emprunt = $this->toObject($empruntDB);
            $emprunts[] = $emprunt;
        }
        return $livres;
    }

    public function create(Livre $livre): void
    {
        $connexion = Database::getConnection();
        $requeteSQL = "INSERT INTO livre VALUES (:isbn, :titre, :dateParution, :nbPages, :idAuteur)";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":isbn", $livre->getIsbn());
        $requete->bindValue(":titre", $livre->getTitre());
        $requete->bindValue(":dateParution", $livre->getDateParution()->format("Y-m-d"));
        $requete->bindValue(":nbPages", $livre->getNbPages());
        $requete->bindValue(":idAuteur", $livre->getAuteur()->getIdAuteur());
        $requete->execute();
    }

    public function delete(string $isbn): void
    {
        $connexion = Database::getConnection();
        $requeteSQL = "DELETE FROM livre WHERE isbn = :isbn";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":isbn", $isbn);
        $requete->execute();
    }

    public function update(Livre $livre): void
    {
        $connexion = Database::getConnection();
        $requeteSQL = "UPDATE livre SET titre = :titre, dateParution = :dateParution, nbPages = :nbPages, idAuteur = :idAuteur WHERE isbn = :isbn";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":isbn", $livre->getIsbn());
        $requete->bindValue(":titre", $livre->getTitre());
        $requete->bindValue(":nbPages", $livre->getNbPages());
        $requete->bindValue(":dateParution", $livre->getDateParution()->format("Y-m-d"));
        $requete->bindValue(":idAuteur", $livre->getAuteur()->getIdAuteur());
        $requete->execute();
    }

    /**
     * @param mixed $empruntDB
     * @return Auteur
     */
    private function toObject(mixed $empruntDB): Emprunt
    {
        $auteur = new Auteur();
        $auteur->setIdAuteur($empruntDB["idAuteur"]);
        $auteur->setPrenom($empruntDB["prenomAuteur"]);
        $auteur->setNom($empruntDB["nomAuteur"]);

        $livre = new Livre();
        $livre->setIsbn($empruntDB["isbn"]);
        $livre->setTitre($empruntDB["titre"]);
        $livre->setDateParution(DateTime::createFromFormat("Y-m-d", $empruntDB["dateParution"]));
        $livre->setNbPages($empruntDB["nbPages"]);
        $livre->setAuteur($auteur);
        return $livre;

        $utilisateur = new Utilisateur();
        $utilisateur->setId($empruntDB["idUtilisateur"]);
        $utilisateur->setNom($empruntDB["nomUtilisateur"]);
        $utilisateur->setPrenom($empruntDB["prenomUtilisateur"]);


        $emprunt = new Emprunt();
        $emprunt->setIdEmprunt($empruntDB["idEmprunt"]);
        $emprunt->setDateEmprunt(DateTime::createFromFormat("Y-m-d",$empruntDB["dateEmprunt"]));
        $emprunt->setUtilisateur($utilisateur);
        $emprunt->setLivre($livre);

        return $emprunt;

    }
}
