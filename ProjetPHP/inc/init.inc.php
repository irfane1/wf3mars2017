<?php
/*
    Le fichier init.php sera inclus dans tous les scripts (hors les fichiers inc eux-mêmes) pour initialiser les éléments suivants :
    - connexion à la BDD
    - création ou ouverture de session
    - définir une constante pour le chemin du site
    - inclusion du fichier fonction.inc.php systématiquement dans tous les scripts
*/

// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=sallea', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


// Session
session_start();

// Chemin du site
define('RACINE_SITE', '/ProjetPHP/');  // indique le dossier dans lequel se situe le site dans 'localhost'

// Déclaration des variables d'affichage du site
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';


// Autres inclusions
require_once('fonction.inc.php');