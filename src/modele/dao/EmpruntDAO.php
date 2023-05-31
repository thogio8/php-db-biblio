<?php

require_once "./src/modele/entites/Emprunt.php";
require_once "./src/modele/config/Database.php";

class EmpruntDAO
{
    /**
     * @return Emprunt[]
     */
    public function findAll(): array
    {
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT * FROM emprunt e, utilisateur u, livre l, auteur a WHERE e.idUtilisateur = u.idUtilisateur AND e.isbn = l.isbn AND l.idAuteur = a.idAuteur";
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


//
    public function findByIsbn(string $isbn): ?array
    {
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT * FROM emprunt e, utilisateur u, auteur a, livre l WHERE e.isbn = :isbn AND e.isbn = l.isbn AND l.idAuteur = a.idAuteur AND e.idUtilisateur = u.idUtilisateur";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":isbn", $isbn);
        $requete->execute();
        $empruntsDB = $requete->fetchAll(PDO::FETCH_ASSOC);
        $emprunts = [];
        foreach ($empruntsDB as $empruntDB){
            // Création d'un objet Auteur
            $emprunt = $this->toObject($empruntDB);
            $emprunts[] = $emprunt;
        }
        //Retourner le résultat
        return $emprunts;
    }

    public function findByUtilisateur(string $nomUtilisateur): ?array
    {
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT * FROM emprunt e, utilisateur u, livre l, auteur a WHERE e.idUtilisateur = u.idUtilisateur AND e.isbn = l.isbn AND l.idAuteur = a.idAuteur LIKE CONCAT('%',:nomUtilisateur,'%')";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":nomUtilisateur", $nomUtilisateur);
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
        return $emprunts;
    }

    public function create(Emprunt $emprunt): void
    {
        $connexion = Database::getConnection();
        $requeteSQL = "INSERT INTO emprunt(dateEmprunt, isbn, idUtilisateur) VALUES (:dateEmprunt, :isbn, :idUtilisateur)";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":dateEmprunt", $emprunt->getDateEmprunt()->format("Y-m-d"));
        $requete->bindValue(":isbn", $emprunt->getLivre()->getIsbn());
        $requete->bindValue(":idUtilisateur", $emprunt->getUtilisateur()->getId());
        $requete->execute();
    }


    public function delete(string $idEmprunt): void
    {
        $connexion = Database::getConnection();
        $requeteSQL = "DELETE FROM emprunt WHERE idEmprunt = :idEmprunt";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":idEmprunt", $idEmprunt);
        $requete->execute();
    }

    public function update(Emprunt $emprunt): void
    {
        $connexion = Database::getConnection();
        $requeteSQL = "UPDATE emprunt SET dateEmprunt = :dateEmprunt, dateRetour = :dateRetour, isbn = :isbn, idUtilisateur = :idUtilisateur WHERE idEmprunt = :idEmprunt";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":dateEmprunt", $emprunt->getDateEmprunt()->format("Y-m-d"));
        $requete->bindValue(":dateRetour", $emprunt->getDateRetour()->format("Y-m-d"));
        $requete->bindValue(":isbn", $emprunt->getLivre()->getIsbn());
        $requete->bindValue(":idUtilisateur", $emprunt->getUtilisateur()->getId());
        $requete->execute();
    }

    /**
     * @param mixed $empruntDB
     * @return Emprunt
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