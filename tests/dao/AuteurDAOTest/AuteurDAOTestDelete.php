<?php

require_once "./src/modele/dao/AuteurDAO.php";

$auteurDAO = new AuteurDAO();

$auteurDAO->delete(8);