<?php
require_once "./src/modele/entites/Utilisateur.php";
require_once "./src/modele/entites/Livre.php";

class Emprunt{
    private int $idEmprunt;
    private DateTime $dateEmprunt;
    private Utilisateur $utilisateur;
    private Livre $livre;

    public function __construct(){

    }

    /**
     * @return int
     */
    public function getIdEmprunt(): int
    {
        return $this->idEmprunt;
    }

    /**
     * @param int $idEmprunt
     */
    public function setIdEmprunt(int $idEmprunt): void
    {
        $this->idEmprunt = $idEmprunt;
    }

    /**
     * @return DateTime
     */
    public function getDateEmprunt(): DateTime
    {
        return $this->dateEmprunt;
    }

    /**
     * @param DateTime $dateEmprunt
     */
    public function setDateEmprunt(DateTime $dateEmprunt): void
    {
        $this->dateEmprunt = $dateEmprunt;
    }

    /**
     * @return Utilisateur
     */
    public function getUtilisateur(): Utilisateur
    {
        return $this->utilisateur;
    }

    /**
     * @param Utilisateur $utilisateur
     */
    public function setUtilisateur(Utilisateur $utilisateur): void
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * @return Livre
     */
    public function getLivre(): Livre
    {
        return $this->livre;
    }

    /**
     * @param Livre $livre
     */
    public function setLivre(Livre $livre): void
    {
        $this->livre = $livre;
    }


}