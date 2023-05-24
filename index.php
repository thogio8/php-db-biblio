<?php
require_once "./src/modele/usecase/afficher les livres/AfficherLivres.php";
require_once "./src/modele/usecase/rechercher livre par ISBN/RechercherLivreParISBN.php";

$rechercherLivreParISBN = new RechercherLivreParISBN();
$afficherLivre = new AfficherLivres();

$livres = $afficherLivre->execute();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>Bibliothèque</title>
</head>
<body>
    <div class="container">
        <h1 class="titre">
            Ma bibliothèque
        </h1>

        <div class="recherche">
            <section class="formcarry-container">
                <form method="post" enctype="multipart/form-data">
                        <div class="formcarry-block">
                            <label for="fc-generated-1-email">Rechercher par ISBN</label>
                            <input type="text" name="isbn" id="fc-generated-1-email" placeholder="111-22-333" />
                        </div>

                        <div class="formcarry-block">
                            <button type="submit">Rechercher</button>
                        </div>

                    </form>
            </section>

            <section class="formcarry-container">
                <form method="post" enctype="multipart/form-data">
                    <div class="formcarry-block">
                        <label for="fc-generated-1-email">Rechercher par nom d'auteur</label>
                        <input type="text" name="auteur" id="fc-generated-1-email" placeholder="Dupont" />
                    </div>

                    <div class="formcarry-block">
                        <button type="submit">Rechercher</button>
                    </div>

                </form>
            </section>
        </div>
        <ul>
            <?php
            foreach ($livres as $livre){ ?>
                <li><?= "ISBN : {$livre->getIsbn()} \t Titre : {$livre->getTitre()}\t Auteur : {$livre->getAuteur()->getNom()} {$livre->getAuteur()->getPrenom()} \t Nombre de pages : {$livre->getNbPages()} \n" ?></li>
            <?php }
            ?>
        </ul>
    </div>
</body>
</html>