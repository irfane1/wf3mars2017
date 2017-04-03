// Attendre le chargement du DOM
$(document).ready(function(){

        // Créer une variable (string) pour le titre principal du site
        var siteTitle = 'Irfane Tayabdjee <span>Etudiant développeur</span>';

        //Créer un tableau pour la nav
        var myNav = [ 'Accueil', 'Portfolio', "Contacts" ];

        // Créer un objet pour les titres des pages
        var myTitles = {
            Accueil: 'Bienvenue sur la page d\'accueil',
            Portfolio: 'Découvrez mes travaux',
            Contacts: 'Contactez-moi pour plus d\'informations'
        };

        // Créer un objet pour le contenu des pages
        var myContent = {
            Accueil: '<h3>Contenu de la page Accueil</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita a quasi sint dolore laborum aspernatur eius qui nostrum! Maxime sequi velit tempore vero dolorum. Sequi quis qui modi dolores iure!</p>',
            Portfolio: '<h3>Contenu de la page Portfolio</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita a quasi sint dolore laborum aspernatur eius qui nostrum! Maxime sequi velit tempore vero dolorum. Sequi quis qui modi dolores iure!</p>',
            Contacts: '<h3>Contenu de la page Contacts</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita a quasi sint dolore laborum aspernatur eius qui nostrum! Maxime sequi velit tempore vero dolorum. Sequi quis qui modi dolores iure!</p>'
        }

        // Sélectionner le header et le mettre dans une variable
        var myHeader = $('header');

        // Générer une balise H1 dans le header avec le contenu de la variable siteTitle
        myHeader.append('<h1>' + siteTitle + '</h1>');

        // Générer une balise nav + ul dans le header
        myHeader.append('<nav><i class="fa fa-bars" aria-hidden="true"></i><ul></ul></nav>');

        // Activer le burgerMenu au clic sur la balise .fa-bars
        $('.fa-bars').click( function(){

            $('nav ul').toggleClass('toggleBurger');

        } );

        
        // Faire une boucle for(){...} sur myNav pour générer les liens de la nav
        for( var i = 0; i < myNav.length; i++ ){

            // Générer les balises html
            $('ul').append('<li><a href="' + myNav[i] +'">' + myNav[i] + '</a></li>');

        };

        // Afficher dans le main le titre issu de l'objet myTitles
        var myMain = $('main');
        myMain.append( '<h2>' + myTitles.Accueil + '</h2>' );
        myMain.append( '<section>' + myContent.Accueil + '</section>' );

        // Ajouter la class active sur la première li de la nav
        $('nav li:first').addClass('active');



        // Capter l'événement clic sur les balises a en bloquant leur comportement naturel
        $('a').click( function(evt){

            // Supprimer la class active des balises li de la nav
            $('nav li').removeClass('active');

            // Bloquer le comportement naturel de la balise
            evt.preventDefault();

            // Connaitre l'occurence de la balise a sur laquelle l'utilisateur a cliqué
            // console.log( $(this) );

            // Récupérer la valeur de l'attribut href
            // console.log( $(this).attr('href') );

            // Vérifier la valeur de l'attribut href pour afficher le bon titre
            if( $(this).attr('href') == 'Accueil' ){
                // Sélectionner la balise h2 pour changer son contenu
                $('h2').text( myTitles.Accueil );

                // Sélectionner la section pour changer le contenu html
                $('section').html( myContent.Accueil );

                // Ajouter la class active sur la balise li de la balise a sélectionnée
                $(this).parent().addClass('active');

            } else if( $(this).attr('href') == 'Portfolio' ){
                // Sélectionner la balise h2 pour changer son contenu
                $('h2').text( myTitles.Portfolio );

                // Sélectionner la section pour changer le contenu html
                $('section').html( myContent.Portfolio );

                // Ajouter la class active sur la balise li de la balise a sélectionnée
                $(this).parent().addClass('active');

            } else{
                // Sélectionner la balise h2 pour changer son contenu
                $('h2').text( myTitles.Contacts );

                // Sélectionner la section pour changer le contenu html
                $('section').html( myContent.Contacts );

                // Ajouter la class active sur la balise li de la balise a sélectionnée
                $(this).parent().addClass('active');

            };

            // Fermer le burgerMenu
            $('nav ul').removeClass('toggleBurger');

        } );






} ); // Fin de la fonction de chargement du DOM