// Attendre le chargement du DOM
$(document).ready(function(){


    // Manipuler le contenu texte du footer
    console.log( $('footer').text() );
    $('footer').text('Sous la licence MIT');


    // Manipuler le contenu HTML du footer
    console.log( $('footer').html() );
    $('footer').html('Sous la licence <b>MIT</b>');



    // Créer des objets pour le contenu des pages
    var homeContent = {
        title: 'Bienvenue sur mon site',
        content: 'Je suis le texte de la page <b>Accueil</b>'
    }

    var portfolioContent = {
        title: 'Bienvenue sur mon Portfolio',
        content: 'Je suis le texte de la page <b>Portfolio</b>'
    }

    var contactContent = {
        title: 'Bienvenue sur la page contact',
        content: 'Je suis le texte de la page <b>Contact</b>'
    }


    // Capter le click sur la première li
    $('li:first').click( function(){

        // Modifier le contenu de la balise h2
        $('h2').text( homeContent.title );

        // Modifier le contenu de la balise p
        $('p').html( homeContent.content );

    } );


    // Capter le click sur la première li
    $('li').eq(1).click( function(){

        // Modifier le contenu de la balise h2
        $('h2').text( contactContent.title );

        // Modifier le contenu de la balise p
        $('p').html( contactContent.content );

    } );

    // Capter le click sur la première li
    $('li:last').click( function(){

        // Modifier le contenu de la balise h2
        $('h2').text( homeContent.title );

        // Modifier le contenu de la balise p
        $('p').html( homeContent.content );

    } );




}); // Fin de la fonction de chargement du DOM