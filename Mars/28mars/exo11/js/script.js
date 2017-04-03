/*
    Créer une application pour calculer une moyenne
    - l'utilisateur a la possibilité d'ajouter autant de notes qu'il le souhaite
    - lorqu'il le souhaite, il peut calculer la moyenne des notes
*/

// Variables globales
var notesArray = []; // => tableau vide
var notesAmount = 0;

// Fonctions
function addNote(){

    // Demander à l'utilisateur d'ajouter une note
    var newNote = prompt('Ajouter une note de 0 à 20');

    // Couverture newNote en variable de type number
    var newNoteNumber = parseInt(newNote);

    // Ajouter la note dans le tableau
    notesArray.push( newNoteNumber );
    console.log(notesArray);

    // Additionner notesAmount et newNote
    notesAmount += newNoteNumber;
    console.log( notesAmount );
};

function average(){

    // La somme de toutes les notes divisée par le nombre de notes
    var averageNote = notesAmount / notesArray.length;

    // Arrondir le résultat
    var roundAverage = Math.round( averageNote );

    console.log('La moyenne est de ' + roundAverage + '/20');

};