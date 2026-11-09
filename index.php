<?php

//Démarrage de la session
session_start();

//Importer les ressources
require_once 'env.php';
require_once 'utils/utils.php';
include 'model/Model.php';
include 'model/ModelPlayer.php';
include 'view/View.php';
include 'view/ViewHome.php';
include 'controller/Controller.php';
include 'controller/ControllerHome.php';

//Création du Model à exploiter avec l'objet PDO nécessaire en utilisant les données du fichier env.php
$modelPlayer = new ModelPlayer(new PDO("mysql:host={$_ENV['dbhost']};dbname={$_ENV['dbname']}",$_ENV['login'],$_ENV['password']));

//Création de la View
$viewHome = new ViewHome();

//Création du controller
$controllerHome = new ControllerHome($modelPlayer,$viewHome);

//Lancer le rendu de la page
$controllerHome->registerPlayer()->displayPlayers()->render();