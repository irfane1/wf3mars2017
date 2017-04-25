<?php

// Création ou ouverture de la session
session_start();   // lorsque j'effectue un session_start(), la session n'est pas recréée car elle existe déjà grâce au session_start() lancé dans le fichier session1.php.

echo 'La session est accessible dans tous les scripts du site : ';
echo '<pre>'; print_r($_SESSION); echo '</pre>';   // affiche le contenu de la session

// Ce fichier session2.php n'a rien à voir avec l'autre, il n'y a pas d'inclusion. Et pourtant il accède à la session en cours créée dans session1.php. Notez que c'est l'identifiant de la session envoyé dans un cookie dans le poste de l'internaute par session1.php qui indique quelle session ouvrir dans session2.php.