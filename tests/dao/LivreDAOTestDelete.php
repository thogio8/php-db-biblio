<?php

require_once "./src/modele/dao/LivreDAO.php";

$livreDAO = new LivreDAO();

$livreDAO->delete("145");