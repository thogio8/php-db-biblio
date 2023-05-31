<?php

require_once "./src/modele/entites/Auteur.php";
require_once "./src/modele/entites/Emprunt.php";


class Livre
{
    private string $isbn;
    private string $titre;
    private DateTime $dateParution;
    private int $nbPages;
    private Auteur $auteur;
    private Emprunt $emprunte;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return DateTime
     */
    public function getDateParution(): DateTime
    {
        return $this->dateParution;
    }

    /**
     * @param DateTime $dateParution
     */
    public function setDateParution(DateTime $dateParution): void
    {
        $this->dateParution = $dateParution;
    }

    /**
     * @return int
     */
    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    /**
     * @param int $nbPages
     */
    public function setNbPages(int $nbPages): void
    {
        $this->nbPages = $nbPages;
    }

    /**
     * @return Auteur
     */
    public function getAuteur(): Auteur
    {
        return $this->auteur;
    }

    /**
     * @param Auteur $auteur
     */
    public function setAuteur(Auteur $auteur): void
    {
        $this->auteur = $auteur;
    }


}
