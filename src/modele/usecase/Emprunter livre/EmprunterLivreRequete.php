<?php

class EmprunterLivreRequete{
    public string $isbn;
    public int $idUtilisateur;

    /**
     * @param string $isbn
     * @param int $idUtilisateur
     */
    public function __construct(string $isbn, int $idUtilisateur)
    {
        $this->isbn = $isbn;
        $this->idUtilisateur = $idUtilisateur;
    }
}