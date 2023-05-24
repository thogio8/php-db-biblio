<?php

require_once "./src/modele/entites/Livre.php";
require_once "./src/modele/config/Database.php";

class LivreDAO {
    /**
     * @return Livre[]
     */
    public function findAll() : array{
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT isbn, titre, dateParution, nbPages, l.idAuteur, prenomAuteur, nomAuteur FROM livre l INNER JOIN auteur a on l.idAuteur = a.idAuteur";
        $requete = $connexion->prepare($requeteSQL);
        $requete->execute();
        $livresDB = $requete->fetchAll(PDO::FETCH_ASSOC);
        $livres = [];
        foreach ($livresDB as $livreDB){
            // Création d'un objet Auteur
            $livre = $this->toObject($livreDB);
            $livres[] = $livre;
        }
        //Retourner le résultat
        return $livres;
    }

    public function findByIsbn(string $isbn) : ?Livre{
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT l.*, a.* FROM livre l INNER JOIN auteur a on l.idAuteur = a.idAuteur WHERE isbn = :isbn";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":isbn", $isbn);
        $requete->execute();
        $livreDB = $requete->fetch(PDO::FETCH_ASSOC);
        if($livreDB === false){
            return null;
        }
        return $this->toObject($livreDB);
    }

    public function findByAuteur(string $nomAuteur) : ?array{
        $connexion = Database::getConnection();
        $requeteSQL = "SELECT l.*, a.* FROM livre l INNER JOIN auteur a on l.idAuteur = a.idAuteur WHERE a.nomAuteur LIKE CONCAT('%',:nomAuteur,'%')";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":nomAuteur", $nomAuteur);
        $requete->execute();
        $livresDB = $requete->fetchAll(PDO::FETCH_ASSOC);
        if($livresDB === false){
            return null;
        }
        $livres = [];
        foreach($livresDB as $livreDB){
            $livre = $this->toObject($livreDB);
            $livres[] = $livre;
        }
        return $livres;
    }

    public function create(Livre $livre) : void {
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

    public function delete(string $isbn) : void {
        $connexion = Database::getConnection();
        $requeteSQL = "DELETE FROM livre WHERE isbn = :isbn";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":isbn", $isbn);
        $requete->execute();
    }

    public function update(Livre $livre) : void {
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
     * @param mixed $livreDB
     * @return Auteur
     */
    private function toObject(mixed $livreDB): Livre
    {
        $auteur = new Auteur();
        $auteur->setIdAuteur($livreDB["idAuteur"]);
        $auteur->setPrenom($livreDB["prenomAuteur"]);
        $auteur->setNom($livreDB["nomAuteur"]);

        $livre = new Livre();
        $livre->setIsbn($livreDB["isbn"]);
        $livre->setTitre($livreDB["titre"]);
        $livre->setDateParution(DateTime::createFromFormat("Y-m-d", $livreDB["dateParution"]));
        $livre->setNbPages($livreDB["nbPages"]);
        $livre->setAuteur($auteur);
        return $livre;
    }
}
