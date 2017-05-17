<?php
// nous avons besoin d'un langage interprété côté serveur pour pouvoir communiquer
// $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$prenom = "";
if(isset($_POST['prenom']))
{
    $prenom = $_POST['prenom'];  // on récupère l'argument fourni via post
}

$tab = array();  // on prépare le tableau array qui contiendra la réponse

$fichier = file_get_contents("fichier.json");  // on récupère le contenu de fichier.json
$json = json_decode($fichier, true);  // on tranforme en tableau array représenté par la variable $json

foreach($json as $valeur)
{
    if($valeur['prenom'] == strtolower($prenom))
    {
        $tab['resultat'] = '<table border="1"><tr>';
        foreach($valeur as $informations)
        {
            $tab['resultat'] .= '<td>' . $informations . '</td>';
        }
        $tab['resultat'] .= '</tr></table>';
    }
}

echo json_encode($tab);  // la réponse