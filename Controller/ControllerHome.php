<?php

//Class ControllerHome
class ControllerHome extends Controller{
    //ATTRIBUT
        
    //CONSTRUCTEUR

    //METHODS
    /*
    displayPlayers() : Elle demande au model de récupérer la totalité des players, avant de fournir ces données à la view.
    */
    public function displayPlayers(): self{
        $this->getView()->setDatas($this->getModel()->findAll());
        return $this;
    }

    /*
    registerPlayer() fait plusieurs choses :
        + Vérifier que l’on reçoive bien le formulaire d’ajout de joueur
         + Mettre en place les sécurités d’usages concernant la réception de formulaire
        + Faire les vérification pour savoir si l’enregistrement a le droit de s’effectuer
         + Effectuer l’enregistrement
        + Quelque soit l’issu (succès ou erreur), fournir un message approprié à la view
    */
    public function registerPlayer(): self{
        // Vérifier que je reçoive un formulaire d'ajout de joueur
        if(isset($_POST['submit'])){

            // Vérifier que tous les champs sont remplis
            if(!empty($_POST['pseudo']) && $_POST['score'] != "" && $_POST['team'] != ""){

                //Vérifier que le score est au bon format
                if(filter_var($_POST['score'], FILTER_VALIDATE_INT) !== false) {
                
                    //Nettoyage des données avec sanitize()
                    $pseudo = sanitize($_POST['pseudo']);
                    $score = $_POST['score'];
                    $idTeam = $_POST['team'];

                    //EXPLOITATION DES DONNEES
                    // -> Les étapes pour enregistrer le joueur
                    $data = $this->getModel()->setPseudo($pseudo)->findByPseudo();

                    //Vérifier si le tableau reçu est vide ou pas
                    if(empty($data)){
                        $this->getModel()->setPseudo($pseudo)->setScore($score)->setIdTeam($idTeam)->add();
                        $this->getView()->setMessage("Le joueur {$pseudo} a bien été enregistré");
                    } else {
                        //Message d'erreur pseudo existant
                        $this->getView()->setMessage("Ce pseudo est déjà utilisé par un autre joueur.");
                    }
                }else{
                    // Message d'erreur si le mot de passe est inférieur à 12 caractères
                    $this->getView()->setMessage("Le score n'est pas au bon format");
                }

            }else{
                // Message d'erreur si l'un des champs n'est pas remplis
                $this->getView()->setMessage("Veuillez remplir tous les champs du formulaire.");
            }

        }
        return $this;
    }

}