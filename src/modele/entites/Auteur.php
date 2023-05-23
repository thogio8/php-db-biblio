<?php

class Auteur
{
    private int $idAuteur;
    private string $nom;
    private string $prenom;

    public function __construct(){

    }

    /**
     * @return int
     */
    public function getIdAuteur(): int
    {
        return $this->idAuteur;
    }

    /**
     * @param int $idAuteur
     */
    public function setIdAuteur(int $idAuteur): void
    {
        $this->idAuteur = $idAuteur;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }


}
