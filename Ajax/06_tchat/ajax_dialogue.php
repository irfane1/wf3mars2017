<?php
require_once("inc/init.inc.php");
$tab = array();
$tab['resultat'] = '';

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$arg = isset($_POST['arg']) ? $_POST['arg'] : '';

if($mode == 'liste_membre_connecte' && empty($arg))
{
    // récupérer le contenu du fichier prenom.txt (file())
    // placer dans $tab['resultat'] le contenu de ce fichier sous la forme '<p>pseudo1</p><p>pseudo2</p>'

    $liste_membre = file("prenom.txt"); // file place chaque ligne dans un indice d'un tableau array représenté par $liste_membre
    foreach($liste_membre as $valeur)
    {
        $tab['resultat'] .= '<p>' . $valeur . '</p>';
    }

}
elseif($mode == 'postMessage') {

    // on teste s'il y a bien un message à enregistrer
    $arg = trim($arg);  // on enlève les espaces avant et après la chaine ainsi que si le message ne possède que des espaces
    if(!empty($arg))  // si le message n'est pas vide, alors on lance un insert into
    {
        // $position = strpos($arg, ">");
        // $arg = substr($arg, $position);
        // les deux lignes précédentes sont à décommenter si l'on enregistre avec le pseudo et le >

        // Mathieu > Bonjour à tous
        // Bonjour à tous
        $arg = addslashes($arg);  // met un \ devant les ' et les "
        // enregistrement du message
        $pdo->query("INSERT INTO dialogue (id_membre, message, date) VALUES ($_SESSION[id_membre], '$arg', NOW())");
     
        $tab['resultat'] = "Message enregistré !";
    }
}
elseif($mode == "message_tchat") {
    // récupérer tous les messages de la table dialogue
    // traitement de l'objet résultat avec un while pour placer la réponse dans $_tab['resultat']

    // $tab['resultat'] .= '<p>Mathieu> Premier message</p>';
    // $tab['resultat'] .= '<p>Mathieu> Deuxième message</p>';    
    $messages = $pdo->query("SELECT membre.pseudo, membre.civilite, dialogue.message FROM dialogue, membre WHERE membre.id_membre = dialogue.id_membre ORDER BY dialogue.date");

    while($message = $messages->fetch(PDO::FETCH_ASSOC))
    {
        if($message['civilite'] == 'm')
        {
            $tab['resultat'] .= '<p class="bleu">' . ucfirst($message['pseudo']) . '> ' . $message['message'] . '</p>';

        } else {
            $tab['resultat'] .= '<p class="rose">' . ucfirst($message['pseudo']) . '> ' . $message['message'] . '</p>';
        }
    }
    
} elseif ($mode == 'liste_membre_connecte' && !empty($arg)) {
    // si $arg n'est pas vide alors on a un pseudo et nous devons le retirer du fichier prenom.txt
    $contenu = file_get_contents('prenom.txt');  // on récupère le contenu du fichier prenom.txt dans la variable $contenu
    $contenu = str_replace($arg, "", $contenu);  // on remplace le pseudo recherché par rien
    file_put_contents('prenom.txt', $contenu);  // on écrase l'ancien contenu par le nouveau où l'on a supprimé le pseudo concerné
}



echo json_encode($tab);