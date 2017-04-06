// Attendre le chargement du DOM
$(document).ready(function(){

    // Créer une fonction pour l'animation d'une compétence 
    function mySkills( paramEq, paramWidth ){

        // Animation des balises p des skills
        $('h3 + ul').children('li').eq(paramEq).find('p').animate({
            width: paramWidth
        });

    };

    // Créer une fonction pour ouvrir la modal
    function openModal(){

        // Ouvrir la modal au clic sur les boutons
        $('button').click(function(){

            // Afficher le titre du projet
            var modalTitle = $(this).prev().text()
            $('#modal span').text( modalTitle );

            // Afficher l'image du projet
            var modalImage = $(this).parent().prev().attr('src');
            $('#modal img').attr( 'src', modalImage ).attr('alt', modalTitle);

            // Afficher la modal
            $('#modal').fadeIn();
        });

        // Fermer la modal au clic sur .fa-times
        $('.fa-times').click(function(){
            $('#modal').fadeOut()
        });
    
    };

    // Créer une fonction pour la gestion du formulaire
    function contactForm(){

        // Capter le focus sur les inputs et le textarea
        $('input:not([type="submit"]), textarea').focus(function(){

            // Sélectionner la balise précédente pour y ajouter la class openedLabel
            $(this).prev().addClass('openedLabel hideError');

        });

        // Capter le blur sur les inputs et le textarea
        $('input, textarea').blur(function(){


            // Vérifier s'il n'y a pas de caractères dans le input
            if( $(this).val().length == 0 ){

                // Sélectionner la balise précédente pour supprimer la class openedLabel
                $(this).prev().removeClass();

            };


        });

        // Supprimer le messsage d'erreur du select
        $('select').focus(function(){

            $(this).prev().addClass('hideError');

        });

        // Supprimer le message d'erreur de la checkbox
        $('[type="checkbox"]').focus(function(){

            if( $(this)[0].checked == false ) {
                $('form p').addClass('hideError');
            }

        });

        // Fermer la modal
        $('.fa-times').click(function(){
            $('#modal').fadeOut();
        });


        // Capter la soumission du formulaire
        $('form').submit(function(evt){

            // Bloquer le comportement naturel du formulaire
            evt.preventDefault();

            // Définir les variables globales du formulaire
            var userName = $('#userName');
            var userEmail = $('#userEmail');
            var userSubject = $('#userSubject');
            var userMessage = $('#userMessage');
            var checkbox = $('[type="checkbox"]');
            var formScore = 0;

            // Vérifier que userName a au minimum 2 caractères
            if( userName.val().length < 2 ){
                // Afficher un message d'erreur                
                $('[for="userName"] b').text('Minimum 2 caractères');
                // version 2 : userName.prev().children('b')

            } else{
                // Incrémenter la valeur de formScore
                formScore++;
            };

            // Vérifier que userEmail a au minimum 5 caractères
            if( userEmail.val().length < 5 ){
                // Afficher un message d'erreur
                $('[for="userEmail"] b').text('Minimum 5 caractères');

            } else{
                // Incrémenter la valeur de formScore
                formScore++;
            };      

            // Vérifier que l'utilisateur a bien selectionné un sujet
            if( userSubject.val() == 'null' ){
                // Afficher un message d'erreur
                $('[for="userSubject"] b').text('Vous devez choisir un sujet');

            } else{
                // Incrémenter la valeur de formScore
                formScore++;
            };

            // Vérifier que userMessage a au minimum 5 caractères
            if( userMessage.val().length < 5 ){
                // Afficher un message d'erreur
                $('[for="userMessage"] b').text('Minimum 5 caractères');

            } else{
                // Incrémenter la valeur de formScore
                formScore++;
            };

            // Vérifier si la checkbox est cochée
            if( checkbox[0].checked == false ){
                // Afficher un message d'erreur
                $('form p b').text('Vous devez accepter les conditions générales');

            } else{
                // Incrémenter la valeur de formScore
                formScore++;
            };

            // Validation finale du formulaire
            if( formScore == 5 ){
              
                console.log('Le formulaire est validé !');

                // Envoi des données dans le fichier de traitement PHP
                // php répond true => continuer le traitement du formulaire

                    // Ajouter la valeur de userName dans la balise h2 span de la modal
                    $('#modal span').text( userName.val() );

                    // Afficher la modal
                    $('#modal').fadeIn();

                    // Vider les champs du formulaire
                    $('form')[0].reset();

                    // Supprimer les messages d'erreur
                    $('form b').text('');

                    // Replacer les labels
                    $('label').removeClass();
            
            };

        });

    };


    // Charger le contenu de home.html dans le main
    $('main').load( 'views/home.html' );



    /*
    BurgerMenu
    */
        // Burger menu : ouverture
        $('h1 + a').click(function(evt){

            // Bloquer le comportement naturel de la balise A
            evt.preventDefault();

            // Appliquer la fonction slideToggle sur la nav
            $('nav').slideToggle();

        });

        // Burger menu : navigation
        $('nav a').click(function(evt){

            // Bloquer le comportement naturel de la balise A
            evt.preventDefault();

            // Masquer le main
            $('main').fadeOut();

            // Créer une variable pour récupérer la valeur de l'attribut href
            var viewToLoad = $(this).attr('href');
            
            // Fermer le burger menu
            $('nav').slideUp(function(){

                // Charger la bonne vue puis afficher le main (callBack)
                $('main').load( 'views/' + viewToLoad, function(){

                    $('main').fadeIn(function(){

                        // Vérifier si l'utilisateur veut voir la page about.html
                        if( viewToLoad == 'about.html' ){

                            // Appeler la fonction mySkills
                            mySkills( 0, '84%' );
                            mySkills( 1, '25%' );
                            mySkills( 2, '50%' );                  
                        
                        };

                        // Vérifier si l'utilisateur est sur la page portfolio.html
                        if( viewToLoad == 'portfolio.html' ){

                            // Appeler la fonction pour ouvrir la modal
                            openModal();                  
                        
                        };

                        // Vérifier si l'utilisateur est sur la page contacts.html
                        if( viewToLoad == 'contacts.html' ){

                            // Déclencher la fonction de gestion du formulaire
                            contactForm();

                        };
                        
                    });

                });

            });

        });


        




}); // Fin de la fonction d'attente de chargement du DOM