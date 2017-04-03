var first = 20;
var second = 20;
var third = 10;

// "et" logique : vérifier que les deux variables ont la même valeur
console.log( first == 20 && second == 20 ); // => true
console.log( first == 10 && third == 10 ); // => false

// "ou" logique : vérifier qu'une des variables a la bonne valeur
console.log( first == 20 || second == 15 ); // => true
console.log( first == 30 || first == 20 ); // => true