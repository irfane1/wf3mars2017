// Créer un tableau contenant 4 prénoms
var users = [ 'John', 'Georges', 'Paul', 'Ringo' ];

console.log(users);

// Faire une boucle for sur le tableau pour saluer chacun des prénoms
for( var i = 0; i < users.length; i++ ){

    console.log(i);
    // Code a exécuter à chaque itération (boucle)
    console.log('Salut ' + users[i]);

};