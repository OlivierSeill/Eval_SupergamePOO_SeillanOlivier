<?php
//Class ModelPlayer
class ModelPlayer extends Model{
    //ATTRIBUT
    private int $idPlayer;
    private string $pseudo;
    private int $score;
    private string $team;
    private int $idTeam;

    //CONSTRUCTEUR

    //GETTER ET SETTER
    /**
     * Get the value of idPlayer
     *
     * @return int
     */
    public function getIdPlayer(): int {
        return $this->idPlayer;
    }

    /**
     * Set the value of idPlayer
     *
     * @param int $idPlayer
     *
     * @return self
     */
    public function setIdPlayer(int $idPlayer): self {
        $this->idPlayer = $idPlayer;
        return $this;
    }

    /**
     * Get the value of pseudo
     *
     * @return string
     */
    public function getPseudo(): string {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @param string $pseudo
     *
     * @return self
     */
    public function setPseudo(string $pseudo): self {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Get the value of score
     *
     * @return int
     */
    public function getScore(): int {
        return $this->score;
    }

    /**
     * Set the value of score
     *
     * @param int $score
     *
     * @return self
     */
    public function setScore(int $score): self {
        $this->score = $score;
        return $this;
    }

    /**
     * Get the value of team
     *
     * @return string
     */
    public function getTeam(): string {
        return $this->team;
    }

    /**
     * Set the value of team
     *
     * @param string $team
     *
     * @return self
     */
    public function setTeam(string $team): self {
        $this->team = $team;
        return $this;
    }

    /**
     * Get the value of idTeam
     *
     * @return int
     */
    public function getIdTeam(): int {
        return $this->idTeam;
    }

    /**
     * Set the value of idTeam
     *
     * @param int $idTeam
     *
     * @return self
     */
    public function setIdTeam(int $idTeam): self {
        $this->idTeam = $idTeam;
        return $this;
    }

    //METHODS
    /*
    findAll() : requête pour récupérer tous les players avec toutes leurs informations (id, pseudo, score, team). Elle retourne un tableau contenant des tableaux associatifs.
    */
    public function findAll():array {
        try{
            //Préparer une requête SELECT pour récupérer les données
            $request = $this->getBdd()->prepare('SELECT p.id_player, p.pseudo, p.score, t.team, p.id_team FROM player p INNER JOIN team t ON t.id_team = p.id_team');

            //Exécuter la requête
            $request->execute();

            //Récupérer la réponse
            //ici fetchAll() pour retourner un tableau contenant des tableaux associatifs (FETCH_ASSOC) des users
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    /*
    findByPseudo() : requête pour récupérer qu’un seul player grâce à son pseudo. Elle retourne un tableau associatif.
    */
    public function findByPseudo():array | bool {
        try{
            //Préparer une requête SELECT pour récupérer les données d'un compte utilisant le pseudo
            $request = $this->getBdd()->prepare('SELECT p.id_player, p.pseudo, p.score, t.team, p.id_team FROM player p INNER JOIN team t ON t.id_team = p.id_team WHERE p.pseudo = ?');

            //BindParam() pour injecter le pseudo dans la requête
            $request->bindParam(1,$this->pseudo,PDO::PARAM_STR);

            //Exécuter la requête
            $request->execute();

            //Récupérer la réponse
            //ici fetch() uniquement, car je n'ai besoin de trouver qu'une seule ligne, et donc qu'un seul et unique tableau associatif au maximum
            return $request->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    /*
    add() : requête pour enregistrer un player en connaissant son pseudo, son score et l’id de sa team (la clé étrangère id_team)
    */
    public function add():void {
        try{
            //Préparer ma requête d'insertion en BDD
            $request = $this->getBdd()->prepare('INSERT INTO player (pseudo, score, id_team) VALUES(?, ?, ?)');

            //C. BindParam pour remplir les ? au sein de la requête
            $request->bindParam(1,$this->pseudo,PDO::PARAM_STR);
            $request->bindParam(2,$this->score,PDO::PARAM_STR);
            $request->bindParam(3,$this->idTeam,PDO::PARAM_STR);

            //D. Envoyer la requête à la BDD, pour exécution
            $request->execute();
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    /* delete() : requête pour supprimer un player en connaissant son id.
    */
    public function delete():void {
        try{
            //Préparer ma requête de suppression en BDD
            $request = $this->getBdd()->prepare('DELETE FROM player WHERE id_player = ?');

            //C. BindParam pour remplir le ? au sein de la requête
            $request->bindParam(1,$this->getIdPlayer(),PDO::PARAM_STR);

            //D. Envoyer la requête à la BDD, pour exécution
            $request->execute();
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    /*
    update() requête pour mettre à jour les données d’un player existant grâce à son id, en connaissant son pseudo, son score et l’id de sa team (la clé étrangère id_team).
    */
    public function update():void {
        try{
            //Préparer ma requête de suppression en BDD
            $request = $this->getBdd()->prepare('UPDATE player SET pseudo = ?, score = ?, id_team = ?  WHERE id_player = ?');

            //C. BindParam pour remplir le ? au sein de la requête
            $request->bindParam(1,$this->getPseudo(),PDO::PARAM_STR);
            $request->bindParam(2,$this->getScore(),PDO::PARAM_STR);
            $request->bindParam(3,$this->getIdTeam(),PDO::PARAM_STR);
            $request->bindParam(4,$this->getIdPlayer(),PDO::PARAM_STR);

            //D. Envoyer la requête à la BDD, pour exécution
            $request->execute();
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}