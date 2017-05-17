<?php

/*
    Créer une fonction permettant de convertir un montant en euros vers un montant en dollars
    américains.

    Cette fonction prendra deux paramètres :
        ● Le montant de type int ou float
        ● La devise de sortie (uniquement EUR ou USD).

    Si le second paramètre est “USD”, le résultat de la fonction sera, par exemple :
    1 euro = 1.085965 dollars américains

    Il faut effectuer les vérifications nécessaires afin de valider les paramètres.
*/



function conversionMonnaie($montant, $devise){
    if($devise == 'EUR'){
            return $montant . ' € = ' . $montant * 1.085965 . ' $';
        }
        elseif($devise == 'USD'){
            return $montant . ' $ = ' . $montant * 0.92083999 . ' €';
        }
        else{
            return 'il y a un problème'; 
        }
    
    }
    echo conversionMonnaie(1, 'EUR'); echo '<br>';
    echo conversionMonnaie(1, 'USD');
?>
