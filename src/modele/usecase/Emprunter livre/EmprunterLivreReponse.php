<?php

class EmprunterLivreReponse{
    public int $statut;
    public string $message;

    /**
     * @param int $statut
     * @param string $message
     */
    public function __construct(int $statut, string $message)
    {
        $this->statut = $statut;
        $this->message = $message;
    }


}