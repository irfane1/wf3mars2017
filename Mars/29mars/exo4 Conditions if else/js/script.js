// Demander à l'utilisateur de choisir une couleur entre rouge, vert et bleu
var userChoice = prompt('Choisir une couleur entre rouge, vert et bleu');

// Si userChoice est égale à 'rouge'
if ( userChoice == 'rouge' ) { // Si userChoice est égale à 'rouge'

    console.log('Rouge se dit Red en anglais');

} else if (userChoice == 'bleu' ) { //Si userChoice est égale à 'rouge'

    console.log('Bleu se dit Blue en anglais');

} else if (userChoice == 'vert' ) { //Si userChoice est égale à 'vert'

    console.log('Vert se dit Green en anglais');

} else { // Dans tous les autres cas

    console.log('Je ne connais pas cette couleur...');

}