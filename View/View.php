<?php
//Class View :
class View {
    //METHODS
    /*
     displayHeader() : effectue un echo de la partie HTML correspondant au header de la page (balise DOCTYPE jusqu’à la balise de fermeture header), puis retourne l’objet $this.
    */
    public function displayHeader(): self {
        ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Evaluation Supergame</title>
                <link rel="stylesheet" href="src/css/style.css">
            </head>
            <body>
                <header></header>
        <?php
        return $this;
    }

    /*
     displayFooter() : effectue un echo de la partie correspondant au footer de la page (balise ouvrante footer jusqu’à la balise de fermeture html), puis retourne l’objet $this.
    */

     public function displayFooter(): self {
        ?>
            <footer>
                <p>Evalution du 9 novembre 2026, réalisée à l'ADRAR Pôle Numérique</p>
            </footer>
            </body>
            </html>
        <?php
        return $this;
    }

}