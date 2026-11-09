<?php
//Class View :
class ViewHome extends View {
    //ATTRIBUT
    private string $message="";
    private array $datas;

    //CONSTRUCTEUR

    //GETTER ET SETTER
    /**
     * Get the value of message
     *
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self {
        $this->message = $message;
        return $this;
    }

    /**
     * Get the value of datas
     *
     * @return array
     */
    public function getDatas(): array {
        return $this->datas;
    }

    /**
     * Set the value of datas
     *
     * @param array $datas
     *
     * @return self
     */
    public function setDatas(array $datas): self {
        $this->datas = $datas;
        return $this;
    }

    //METHODS
    /*
      displayMain() : effectue un echo de la partie HTML correspondant au <main>. Son but est d’avoir un formulaire d’ajout de joueur (pseudo, score, et un menu déroulant pour les teams Chaque Option de ce Select associe un nom d’équipe de la base de données à la valeur de son id. Pour les besoins de l’exercice, faite cela en dur dans le HTML, sans utiliser de requête à la BDD :
    + value : 1, affiche Aucune
    + value : 2, affiche TeamRocket
    + value : 3, affiche DreamTeam
    Il y aura aussi un message de confirmation ou d’erreur pour ce formulaire. De plus, ce <main> affiche aussi la liste de tous les joueurs (pseudo, score, team)
    */
    public function displayMain(): self {
    ?>
            <main>
                <h1>Page Accueil</h1>
                <section>
                    <h2>Ajout de Joueur</h2>
                    <form action="" method="post">
                        <label for="pseudo">Pseudo <input type="text" name="pseudo" id="pseudo"></label>
                        <label for="score">Score <input type="number" name="score" id="score"></label>
                        <label for="team">Team</label>
                            <select name="team" id="team">
                                <optgroup label="Team">
                                    <option value="1">Aucune</option>
                                    <option value="2">TeamRocket</option>
                                    <option value="3">DreamTeam</option>
                                </optgroup>
                            </select>
                        <input type="submit" name="submit">
                    </form>
                    <p>
                        <?php
                            //Affichage du message de confirmation ou d'erreur 
                            echo(htmlentities($this->getMessage())) ?>
                    </p>
                </section>
                <section>
                    <h2>Liste des Joueurs</h2>
                    <ul>
                    <?php 
                        foreach($this->getDatas() as $joueurs){
                            //Affichage en nettoyant les données provenant de la BDD
                            echo("<li>".htmlentities($joueurs['pseudo'])." - Score : ".htmlentities($joueurs['score'])." - Team : ".htmlentities($joueurs['team'])."</li>");
                        } 
                    ?>
                    </ul>
                </section>
            </main>
    <?php
    return $this;
    }

    /*
     displayAll() : effectue le lancement de chaque display dans le bon ordre : displayHeader(), displayMain(), displayFooter()
    */

     public function displayAll(): void {
        $this->displayHeader()->displayMain()->displayFooter();
    }
    

    
}