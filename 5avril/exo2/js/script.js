// Attendre le chargement du DOM
$(document).ready(function(){

    /*
    homePage
    */

        // Burger menu : ouverture
        $('.homePage h1 + a').click(function(evt){

            // Bloquer le comportement naturel de la balise A
            evt.preventDefault();

            // Appliquer la fonction slideToggle sur la nav
            $('.homePage nav').slideToggle();

        });

        // Burger menu : navigation
        $('.homePage nav a').click(function(evt){

            // Bloquer le comportement naturel de la balise A
            evt.preventDefault();

            var linkToOpen = $(this).attr('href');
            
            // Fermer le burger menu
            $('.homePage nav').slideUp(function(){

                // Changer de page
                window.location = linkToOpen;

            });

        });


    /*
    aboutPage
    */
        // Capter le click sur le burger menu
        $('.aboutPage h1 + a').click(function(evt){

            // Bloquer le comportement naturel de la balise A
            evt.preventDefault();

            // Sélectionner la nav pour y appliquer une fonction animate
            $('.aboutPage nav').animate({
                left: '0'
            });

        });

        // Burger menu : navigation
        $('.homePage nav a').click(function(evt){

            // Bloquer le comportement naturel de la balise A
            evt.preventDefault();

            var linkToOpen = $(this).attr('href');
            
            // Fermer le burger menu
            $('.aboutPage nav').animate({
                left: '-100%'
            
            }, function(){

                // Changer de page
                window.location = linkToOpen;

            });

        });



}); // Fin de la fonction d'attente de chargement du DOM