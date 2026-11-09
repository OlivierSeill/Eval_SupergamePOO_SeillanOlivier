<?php
//Class Model 
class Model {
    //ATTRIBUT
    private PDO $bdd;

    //CONSTRUCTEUR
    public function __construct(PDO $newPdo){
        $this->bdd = $newPdo;
    }

    //GETTER ET SETTER
    /**
     * Get the value of pdo
     *
     * @return PDO
     */
    public function getBdd(): PDO {
        return $this->bdd;
    }

    /**
     * Set the value of pdo
     *
     * @param PDO $pdo
     *
     * @return self
     */
    public function setBdd(PDO $pdo): self {
        $this->bdd = $pdo;
        return $this;
    }
}