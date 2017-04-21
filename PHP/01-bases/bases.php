<style>h2{font-size: 15px; color: red;}</style>


<?php

//----------------------------------
echo '<h2> Les balises PHP </h2>';
//----------------------------------
?>

<?php
// Pour ouvrir un passage en PHP, on utilise la balise précédente
// Pour fermer un passage en PHP, on utilise la balise suivante :
?>

<strong>Bonjour</strong> <!-- en dehors des balises d'ouverture et de fermeture du PHP, nous pouvons écrire du HTML -->


<?php
//----------------------------------
echo '<h2> Ecriture et affichage </h2>';
//----------------------------------
echo 'Bonjour';  // echo est une instruction qui nous permet d'effectuer un affichage. Notez que les instructions se terminenet par un ";"
echo '<br>';  // on peut mettre des balises HTML dans un echo, elles sosnt interprétées comme telles.$_COOKIE

print 'Nous sommes jeudi';  // print est une autre instruction d'affichage.

// Pour info, il existe d'autres instructions d'affichage (cf plus loin dans le cours) :
// print_r();
// var_dump();


//----------------------------------
echo '<h2> Variable : types / déclaration / affectation </h2>';
//----------------------------------
// Définition : une variable est un espace mémoire nommé qui permet de conserver une valeur.
// En PHP, on déclare une variable avec le signe $

$a = 127;  // je déclare la variable a, et je lui affecte la valeur 127
// Le type de la variable a est integer (entier)

$b = 1.5;  // un type double pour nombre à virgule

$a = 'une chaine de caractères';  // type string pour une chaine de caractères
$b = '127';  // il s'agit aussi d'un string car il a des guillemets

$a = true;  // type boolean qui ne prend que deux valeurs possibles : true ou false


//----------------------------------
echo '<h2> Concaténation </h2>';
//----------------------------------
$x = 'bonjour ';
$y = 'tout le monde';
echo $x . $y . '<br>';  // point de concaténation que l'on peut traduire par 'suivi de'

echo "$x $y <br>";  // on obtient le même résultat  sans concaténation (cf chapitre d'après pour l'explication de l'évaluation des variables dans les guillemets)

//---------
// Concaténation lors de l'affectation
$prenom1 = 'Bruno';  // déclaration de la variable $prenom1
$prenom1 = 'Claire';  // ici la valeur "Claire" écrase la valeur précédente "Bruno" qui était contenue dans la variable
echo $prenom1 . '<br>';  // affiche CLaire

$prenom2 = 'Bruno';
$prenom2 .= 'Claire';  // on affecte la valeur 'Claire' à la variable $prenom2 en l'ajoutant à la valeur précédemment contenue dans la variable grâce à l'opérateur .=
echo $prenom2 . '<br>';  // affiche BrunoClaire





//----------------------------------
echo '<h2> Guillemets et quotes </h2>';
//----------------------------------
$message = "aujourd'hui";  // ou bien :
$message = 'aujourd\'hui';  // dans les quotes on échappe les apostrophes avec l'anti-slash (alt gr + 8)

$txt = 'Bonjour';
echo "$txt tout le monde <br>";  // les variables sont évaluées quand elles sont présentes dans des guillemets, c'est leur contenu qui est affiché
echo '$txt tout le monde <br>';  // dans des quotes simples, on affiche littéralement le nom des variables : elles ne sont pas évaluées



//----------------------------------
echo '<h2> Constantes </h2>';
//----------------------------------
// Une constante permet de conserver une valeur qui ne peut pas (ou ne doit pas) être modifiée durant la durée du script. Très utile pour garder de manière certaine la connexion à une BDD ou le chemin du site par exemple.

define("CAPITALE", "Paris");  // par convention, on écrit toujours le nom des constantes en MAJUSCULES. define permet de déclarer une constante dont on indique d'abord le nom puis la valeur.
echo CAPITALE . '<br>';  // affiche Paris

// Constantes magiques
echo __FILE__ . '<br>';  // affiche le chemin complet du fichier dans lequel on est.
echo __LINE__ . '<br>';  // affiche la ligne à laquelle on est.


//----------------------------------
echo '<h2> Opérateurs arithmétiques </h2>';
//----------------------------------
$a = 10;
$b = 2;

echo $a + $b . '<br>';  // affiche 12
echo $a - $b . '<br>';  // affiche 8
echo $a * $b . '<br>';  // affiche 20
echo $a / $b . '<br>';  // affiche 5
echo $a % $b . '<br>';  // affiche 0 (= le reste de la division entière)

//-----
// Opérations et affectations combinées
$a += $b;  // $a vaut 12 car équivaut à $a = $a + $b soit 10 + 2
$a -= $b;  // $a vaut 10 car équivaut à $a = $a - $b soit 12 - 2
$a *= $b;  // $a vaut 20 car équivaut à $a = $a * $b soit 10 * 2
$a /= $b;  // $a vaut 10 car équivaut à $a = $a / $b soit 20 / 2
$a %= $b;  // $a vaut 0 car équivaut à $a = $a % $b soit le reste de 10 / 2

//-----
// Incrémenter et décrémenter
$i = 0;
$i++;  // incrémentation de $i de +1 (vaut 1)
$i--;  // décrémentation de $i de -1 (vaut 0)

$k = ++$i;  // la variable est incrémentée de 1, puis elle est affectée à $k
echo $i . '<br>';  // 1
echo $k . '<br>';  // 1

$k = $i++;  // la variable $i est d'abord affectée à $k puis incrémentée de 1
echo $i . '<br>';  // 2
echo $k . '<br>';  // 1


//----------------------------------
echo '<h2> Structures conditionnelles et opérateurs de comparaison </h2>';
//----------------------------------
$a = 10; $b = 5; $c = 2;

if ($a > $b) {  // si la condition renvoie true, on exécute les accolades qui suivent :
    echo '$a est bien supérieur à $b <br>';
} else {  // sinon (si la condition renvoie false), on exécute le else :
    echo 'Non, c\'est $b qui est supérieur à $a <br>';
}

//-----
if ($a > $b && $b > $c) {  // && signifie ET
    echo 'Les 2 conditions sont vraies <br>';
}

//-----
$a = 10; $b = 5; $c = 2;
if ($a == 9 || $b > $c) {  // l'opérateur de comparaison est == et l'opérateur OU s'écrit ||
    echo 'OK pour une des deux conditions <br>';
} else {
    echo 'Les deux conditions sont fausses <br>';
}

//-----
$a = 10; $b = 5; $c = 2;
if ($a == 8) {
    echo 'Reponse 1 <br>';
} elseif ($a != 10) {  // sinon si $a différent de 10, on exécute les accolades qui suivent :
    echo 'Reponse 2 <br>';
} else {  // sinon si les conditions précédentes sont fausses, on exécute les accolades qui suivent :
    echo 'Reponse 3 <br>';  // on entre ici dans le else
}

//-----
if ($a == 10 XOR $b == 6) {
    echo 'ok pour la condition exclusive <br>';  // si les deux conditions sont vraies ou les deux conditions sont fausses en même temps, nous n'entrons pas dans les accolades
}
// Pour que la condition s'exécute, il faut que l'une soit vraie ou alors que l'autre soit vraie, mais pas les deux en même temps.


//-----
// Conditions ternaires (forme contractée de la condition) :
echo ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>';
// Le ? remplace le if, et le : remplace le else. Si a vaut 10 on fait un echo du premier string, sinon du second.

//-----
// Différence entre == et ===
$vara = 1;  // integer
$varb = '1';  // string

if ($vara == $varb) {
    echo 'il y a égalité en valeur entre les 2 variables <br>';
}
if ($vara === $varb) {
    echo 'il y a égalité en valeur ET en type entre les 2 variables <br>';
}
// Avec la présence du triple =, la comparaison ne fonctionne pas car les variables ne sont pas du même type : on compare un integer avec un string.
// Avec le double =, on ne compare que la valeur : ici la comparaison est donc juste.

/*
=   signe d'affectation
==  comparaison en valeur
=== comparaison en valeur et en type
*/

//-----
// empty() et isset()
// empty() : teste si c'est vide (c'est-à-dire 0, '', NULL, false ou non défini)
// isset() : teste si c'est défini et a une valeur non NULL

$var1 = 0;
$var2 = '';  // chaîne vide sans espace

if (empty($var1)) echo 'on a 0, vide, ou non définie <br>';
if (isset($var2)) echo 'var2 existe bien <br>';

// différence entre empty et isset : si on met les lignes 204 et 205 en commentaire (pour les neutraliser), empty reste vrai car $var1 n'est pas définie, alors que isset est faux car $var2 n'est pas définie.

// empty sera utilisé pour vérifier, par exemple, que les champs d'un formulaire sont remplis. isset permettra par exemple de vérifier l'existence d'un indice dans un array avant de l'utiliser.




//----------------------------------
// Entrer une valeur dans une variable sous condition (PHP7)
$var1 = isset($maVar) ? $maVar : 'valeur par défaut';  // dans cette ternaire, on affecte la valeur de $maVar à $var1 si elle existe. Celle-ci n'existant pas, on lui affecte 'valeur par défaut'
echo $var1 . '<br>';  // affiche 'valeur par défaut'

// En version PHP7
$var2 = $maVar ?? 'valeur par défaut';  // on fait exactement la même chose mais en plus court : le "??" signifie "soit l'un soit l'autre", "prends la première valeur qui existe"
echo $var2 . '<br>';

$var3 = $_GET['pays'] ?? $_GET['ville'] ?? 'pas d\'info';  // soit on prend le pays s'il existe, sinon on prend la ville si elle existe, sinon on prend 'pas d'info' par défaut
echo $var3 . '<br>';


//----------------------------------
echo '<h2> Conditions switch </h2>';
//----------------------------------
// Dans le switch ci-dessous, les "case" représentent les cas différents dans lesquels on peut potentiellement tomber.
$couleur = 'jaune';

switch($couleur) {
    case 'bleu' : echo 'Vous aimez le bleu'; break;
    case 'rouge' : echo 'Vous aimez le rouge'; break;
    case 'vert' : echo 'Vous aimez le vert'; break;
    default : echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert <br>';
}

// Le switch compare la valeur de la variable entre parenthèses à chaque case. Lorsqu'une valeur correspond, on exécute l'instruction en regard du case, puis le break qui indique qu'il faut sortir de la condition.
// Le default correspond à un else : on l'exécute par défaut quand aucun case ne correspond.

// Exercice : écrivez la condition switch ci-dessus avec des if
$couleur = 'jaune';
if ($couleur == 'bleu') {
    echo 'Vous aimez le bleu';
} else if ($couleur == 'rouge') {
    echo 'Vous aimez le rouge';
} else if ($couleur == 'vert') {
    echo 'Vous aimez le vert';
} else {
    echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert <br>';
}


//----------------------------------
echo '<h2> Fonction prédéfinies </h2>';
//----------------------------------
// Une fonction prédéfinie permet de réaliser un traitement spécifique qui est prévu dans le langage.

//-------------------
echo '<h2>Traitement des chaînes de caractères (strlen, strpos, substr)</h2>';
$email1 = 'prenom@site.fr';

echo strpos($email1, '@') . '<br>';  // strpos() indique la position 6 du caractère "@" dans la chaîne $email1
echo strpos('Bonjour', '@');
var_dump(strpos('Bonjour', '@'));
// Quand j'utilise une fonction prédéfinie, il faut se demander quels sont les arguments à lui fournir pour qu'elle s'exécute correctement, et ce qu'elle peut retourner comme résultat.
// Dans l'exemple de strpos() : succès => integer, échec => booléen false.

//--------------------
$phrase = 'Mettez une phrase à cet endroit';
echo '<br>'. strlen($phrase) . '<br>';  // affiche la longueur du string : succès => integer, échec => false.

//--------------------
$texte = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos earum tempora fuga, velit error obcaecati quibusdam fugiat atque adipisci sapiente, ab officia harum, corporis cupiditate, natus quisquam voluptate in perferendis.';
echo substr($texte, 0, 20) . '...<a href="">Lire la suite</a><br>';  // on découpe une partie du texte et on lui concatène un lien. Succès => string, échec => false.$_COOKIE

//--------------------
echo str_replace('site', 'gmail', $email1);  // remplace 'site' par 'gmail' dans le string contenu dans $email1

//--------------------
$message ='     Hello world     ';
echo strtolower($message) . '<br>';  // passe le string en minuscules
echo strtoupper($message) . '<br>';  // passe le string en majuscules

echo strlen($message) . '<br>';
echo strlen(trim($message)) . '<br>';  // trim() permet de supprimer les espaces au début et à la fin d'un string


//----------------------------------
echo '<h2> Le manuel PHP en ligne </h2>';
//----------------------------------
// Le manuel PHP en ligne :
http://php.net/manual/fr/



//----------------------------------
echo '<h2> Gestion des dates </h2>';
//----------------------------------
echo date('d/m/Y H:i:s') . '<br>';  // affiche la date et heure de l'instant selon le format indiqué : d = day, m = month, Y = year sur 4 chiffres, y = year sur 2 chiffres, H = heures sur 24h, i = minutes, s = secondes. On peut choisir les séparateurs

echo time() . '<br>';  // retourne le timestamp actuel = nombre de secondes écoulées depuis le 01/01/1970 à 00:00:00 (création théorique de UNIX)

// La fonction prédéfinie strtotime()
$dateJour = strtotime('10-01-2016');  // retourne le timestamp de la date indiquée
echo $dateJour . '<br>';

// La fonction strftime()
$dateFormat = strftime('%Y-%m-%d', $dateJour);  // transforme le timestamp donné en date selon le format indiqué, ici YYY-MM-DD 
echo $dateFormat . '<br>';  // affiche 2016-01-10

// Exemple de conversion de format de date
// Transformer 23-05-2015 en 2015-05-23 :
echo strftime('%Y-%m-%d', strtotime('23-05-2015'));

echo '<br>';
// Transformer 2015-05-23 en 23-05-2015 :
echo strftime('%d-%m-%Y', strtotime ('2015-05-23'));


// Cette méthode de transformation est limitée dans le temps (2038)... On peut donc utiliser une autre méthode avec la classe DateTime
$date = new DateTime('11-04-2017');
echo $date->format('Y-m-d');
// DateTime est une classe que l'on peut comparer à un plan ou un modèle qui sert à construire des objets "date".
// On construit un objet "date" avec le mot new, en indiquant la date qui nous intéresse entre parenthèses. $date est donc un objet "date".
// Cet objet bénéficie de méthodes (= fonctions) offertes par la classe : il y a entre autres la méthode format() qui permet de modifier le format d'une date. Pour appeler cette méthode sur l'objet $date, on utilise la flèche "->".



//----------------------------------
echo '<h2> Les fonctions utilisateurs </h2>';
//----------------------------------
// Les fonctions qui ne sont pas prédéfinies dans le langage sont déclarées puis exécutées par l'utilisateur.

// Déclaration d'une fonction
function separation() {
    echo '<hr>';    // simple fonction permettant de tirer un trait dans la page web
}

// Appel de la fonction par son nom
separation();   // ici on exécute la fonction



//--------------
// Fonction avec arguments : les arguments sont des paramètres fournis à la fonction et lui permettent de compléter ou modifier le comportement initialement prévu
function bonjour ($qui) {  // $qui apparait ici pour la première fois : il s'agit d'une variable de réception qui reçoit la valeur d'un argument
    return 'Bonjour ' . $qui . '<br>';  // return permet de renvoyer ce qui suit le return à l'endroit où la fonction est appelée
    echo 'cette ligne ne sera pas exécutée';  // après un return, on quitte la fonction donc on n'exécute pas le code qui suit
}

// Appel de la fonction
echo bonjour('Pierre');  // on appelle la fonction en lui donnant le string 'Pierre' en argument => affiche 'Bonjour Pierre'

$prenom = 'Etienne';
echo bonjour($prenom);  // l'argument peut être une variable : affiche 'Bonjour Etienne'


//--------------------------
// Exercice
function appliqueTva($nombre) {
    return $nombre * 1.2;
}

// Ecrivez une fonction appliqueTva2 sur la base de la précédente, mais en donnant la possibilité de calculer un nombre avec le taux de notre choix.
function appliqueTva2($nombre, $taux) {  // on ne peut pas redéclarer une fonction avec le même nom
    return $nombre * $taux;
}

echo appliqueTva2(100,1.5) . '<br>';  // lorsqu'une fonction attend des arguments, il faut obligatoirement les lui donner


//--------------------------
// Exercice
function meteo($saison, $temperature) {
    echo "Nous sommes en $saison et il fait $temperature degré(s) <br>";
}

meteo('hiver', 2);
meteo('printemps', 2);

// Créer une fonction meteo2 qui permet d'afficher 'au printemps" quand il s'agit du printemps

function meteo2($saison, $temperature) {
    if ($saison == 'printemps') {
        $article = 'au';
    } else {
        $article = 'en';
    }
    echo "Nous sommes $article $saison et il fait $temperature degré(s) <br>";    
}

meteo2('printemps', 2);

// Version ternaire
function meteo3($saison, $temperature) {
    $article = ($saison == 'printemps') ? 'au' : 'en';
    echo "Nous sommes $article $saison et il fait $temperature degré(s) <br>";        
}
meteo3('printemps', 2);
meteo3('hiver', 2);


//---------
// Exercice
function prixLitre() {
    return rand(1000,2000)/1000;    // détermine un prix aléatoire entre 1 et 2€
}

// Ecrivez la fonction factureEssence() qui calcule le prix total de votre facture d'essence en fonction du nombre de litres que vous lui donnez. Cette fonction retourne la phrase "Votre facture est de X euros pour Y litres d'essence" (X et Y sont variables).
// Dans cette fonction, utilisez la fonction prixLitre() qui vous retourne le prix du litre d'essence.
function factureEssence($nombreLitre){
    $totalFacture = $nombreLitre * prixLitre();
    echo "Votre facture est de $totalFacture euros pour $nombreLitre litres d'essence <br>";
}

factureEssence(50);







//----------------------------------
echo '<h2> Les variables locales et globales </h2>';
//----------------------------------

function jourSemaine() {
    $jour = 'vendredi';  // ici dans la fonction nous sommes dans un espace LOCAL. La variable $jour est donc LOCALE.
    return $jour;
}

// A l'extérieur de la fonction, je suis dans l'espace GLOBAL

// echo $jour;   // je ne peux pas utiliser une variable locale dans l'espace global
echo jourSemaine() . '<br>';  // on peut cependant récupérer la valeur de $jour grâce au return qui est au sein de la fonction et à l'appel de cette fonction


//-------
$pays = 'France';   // variable globale
function affichagePays() {
    global $pays;  // le mot clé global permet de récupérer une variable provenant de l'espace global au sein de l'espace local de la fonction
    echo $pays;   // on peut donc utiliser cette variable $pays
}

affichagePays();




//----------------------------------
echo '<h2> Les structures itératives : boucles </h2>';
//----------------------------------
// boucle while
$i = 0;   // valeur de départ de la boucle
while ($i < 3) {
    echo "$i---";  // tant que $i est inférieur à 3, j'exécute les accolades qui suivent
    $i++;   // on n'oublie pas d'incrémenter $i pour que la boucle ne soit pas infinie (il faut que la condition puisse devenir false à un moment donné)
}

echo '<br>';

//---
$j = 0;
while ($j < 3) {
    if ($j == 2) {
    echo $j;
    } else {
    echo "$j---";
    }
    $j++;
}

echo '<br>';

//----
// Exercice : à l'aide d'une boucle while, afficher dans un sélecteur les années depuis l'année en cours moins 100 ans et jusqu'à l'année en cours : 1917 => 2017

?>
<select>
<?php
$a = date('Y') - 100;   // équivaut à 1917

while($a <= date('Y')) {    // équivaut à $a <= 2017
    echo "<option>$a</option>";
    $a++;
}
echo '</select>';



//---------------------------------------
// Boucle do while
// La boucle do while a la particularité de s'exécuter au moins UNE fois, puis tant que la condition de fin est vraie.
echo '<br>Boucle do while<br>';

do {
    echo 'un tour de boucle';
} while (false);  // on met la condition pour exécuter les tours de boucle ici à la place de false. Dans ce cas précis, on voit que l'on effectue un tour de boucle bien que la condition soit fausse

// Notez la présence du ";" à la fin de la boucle do while (contrairement aux autres structures itératives).

//---------------------------------------
// Boucle for
echo '<br>';
for($j = 0; $j < 16; $j++) {  // initialisation de la valeur de départ ; condition d'entrée dans la boucle ; incrémentation (ou décrémentation)
    print $j . '<br>';
}


//---
// Exercice :
// 1- Faire une boucle qui affiche 0 à 9 sur la même ligne
// 2- Faites la même chose mais dans un tableau HTML
// 1-
for($i = 0; $i <= 9; $i++) {  // initialisation de la valeur de départ ; condition d'entrée dans la boucle ; incrémentation (ou décrémentation)
    print $i;
}

// 2-
echo '<table border="1">';
    echo '<tr>';
        for($p =0; $p <= 9; $p++) {
            print "<td>$p</td>";
        }
    echo '</tr>';
echo '</table>';


echo '<br>';

// Exercice : faire un tableau HTML de 10 colonnes sur 10 lignes à partir du code précédent
echo '<table border="1">';
  for($l = 0; $l < 10; $l++) {
        echo '<tr>';
            for($p = 0; $p <= 9; $p++) {
                print "<td>$p</td>";
            }
        echo '</tr>';
  }  
echo '</table>';

// Version en while
echo '<hr>';

echo '<table border="1">';
    // on fait une boucle pour les lignes
    $i = 0;
    while($i < 10) {
        echo '<tr>';
            // on fait une boucle pour les colonnes
            for($p =0; $p <= 9; $p++) {
                print "<td>$p</td>";
            }
        $i++;
        echo '</tr>';
    }
echo '</table>';



//----------------------------------
echo '<h2> Les arrays ou tableaux </h2>';
//----------------------------------
// On peut stocker dans un array une multitude de valeurs quelque soit leur type.

$liste = array('grégoire', 'nathalie', 'émilie', 'françois', 'georges');  // déclaration d'un array appelé $liste contenant des prénoms

// echo $liste;  // erreur car on ne peut pas afficher directement le contenu d'un array

echo '<pre>'; var_dump($liste); echo '</pre>';
echo '<pre>'; print_r($liste); echo '</pre>';
// Ces deux instructions d'affichage permettent d'indiquer le type de l'élément mis en argument ainsi que son contenu. Les balises <pre> servent à faire une mise en forme. Notez que ces deux instructions ne sont utilisées qu'en phase de développement.

// Autre moyen d'affecter des valeurs dans un tableau
$tab[] = 'France';  // permet d'ajouter la valeur 'France dans le tableau $tab
$tab[] = 'Italie';
$tab[] = 'Espagne';
$tab[] = 'Portugal';

echo '<pre>';print_r($tab);  // pour voir le contenu du tableau

// Pour afficher la valeur Italie qui se situe à l'indice 1
echo $tab[1] . '<br>';  // affiche Italie


//------------------------------
// Tableau associatif : tableau dont les indices sont littéraux
$couleur = array("j" => "jaune", "b" => "bleu", "v" => "vert");  // on peut choisir le nom des indices

// Pour accéder à un élément du tableau associatif
echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>';  // affiche bleu
echo "La seconde couleur de notre tableau est le $couleur[b] <br>";  // affiche bleu. Un array écrit dans des guillemets perd ses quotes autour de son indice.


//------------------------------
// Mesurer la taille d'un array
echo 'Taille du tableau : ' . count($couleur) . '<br>';  // compte le nombre d'éléments dans l'array $couleur, ici 3
echo 'Taille du tableau : ' . sizeof($couleur) . '<br>';  // compte le nombre d'éléments dans l'array $couleur, ici 3


//-------------------------------
// Transformer un array en string
$chaine = implode('-', $couleur);  // implode() rassemble les éléments d'un array en une chaîne séparés par le séparateur '-' ici
echo $chaine . '<br>';

$couleur2 = explode('-', $chaine);  // transforme une chaîne en array en séparant les éléments grâce au séparateur indiqué (ici un "-"). $couleur2 est un array aux indices numériques
print_r($couleur2);


//----------------------------------
echo '<h2>La boucle foreach pour parcourir les arrays</h2>';
// La boucle foreach est un moyen simple de passer en revue un tableau. Elle fonctionne uniquement sur les arrays et les objets. Et elle a l'avantage d'être automatique, s'arrêtant quand il n'y a plus d'éléments.

echo '<pre>';print_r($tab);

foreach($tab as $valeur) {   // la variable de la valeur que l'on appelle comme on veut, récupère à chaque boucle les valeurs qui sont parcourues dans l'array $tab. ["parcourt l'array $tab par ses valeurs"]
    echo $valeur . '<br>';
}


foreach($tab as $indice => $valeur) {  // on parcourt l'array $tab par ses indices auxquels on associe les valeurs
    echo $indice . ' correspond à ' . $valeur . '<br>';
}






// phpinfo();