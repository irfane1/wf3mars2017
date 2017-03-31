// Créer un objet contenant 4 propriétés
var users = {
    first: 'Nesta',
    second: 'Bunny',
    third: 'Peter',
    fourth: 'Lee'
};

// Faire une boucle for..in sur l'objet
for( var prop in users ){

    // Afficher le nom de la propriété
    console.log( prop );

    // Afficher la valeur des propriétés
    console.log( users[prop] );

};