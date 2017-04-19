// Attendre le chargement du DOM
$(document).ready(function(){

    // Charger le contenu : header.html
    $.get('html/header.html').done(function(content){
        $('header').append(content);

    }).always(function(){
        // Activer le formulaire d'inscription
        logInFormActive();
    });
    
    // Charger le contenu : footer.html
    $.get('html/footer.html').done(function(content){
        $('footer').append(content);
    });

    // Charger le contenu : map.html
    $.get('html/map.html').done(function(content){
        $('main article:first').append(content);
    });

    // Charger le contenu : signin.html
    $.get('html/signin.html').done(function(content){
        $('main article:last').append(content);

    }).always(function(){
        // Activer le formulaire d'inscription
        signInFormActive();
    });

    

    /*
    Formulaire de connexion
    */
        function logInFormActive(){
            // Faire une reqête Ajax en POST déclenchée par la soumission d'un formulaire
            $('header form').submit(function(evt){
                evt.preventDefault();

                $.ajax({

                    // Header de la requête
                    url: 'php/connexion.php',
                    type: 'POST',
                    // La méthode POST envoie des données dans le fichier référencé dans l'URL
                    data: $('form').serialize(),

                    // Corps de la requête
                    success: function(echoPhp){
                        
                        // Vérifier la valeur du echo PHP
                        if(echoPhp == true){
                            // Afficher le popIn
                            $('header aside p').text('Vous êtes à présent connecté')
                            $('header aside').fadeIn(250);
                            
                            // Vider le formulaire
                            $('header form')[0].reset();

                        } else{
                            // Afficher le popIn
                            $('header aside p').text('Vos identifiants ne sont pas reconnus')
                            $('header aside').fadeIn(250);
                        };
                    },
                    error: function(err){
                        // Afficher le popIn
                        $('header aside p').text('Problème de requête : ' + err.status)
                        $('header aside').fadeIn(250);
                    }

                });

            });

            // Fermer les popIns
            $('header aside a').click(function(evt){
                evt.preventDefault();
                $(this).parent().parent().fadeOut(250);
            });

        };

    
    /*
    Formulaire d'inscription
    */
        function signInFormActive(){
            $('main form').submit(function(evt){
                evt.preventDefault();

                // Vérification des valeurs du formulaire
                var formScore = 0;
                var firstnameSignin = $('[name="firstnameSignin"]');
                var lastnameSignin = $('[name="lastnameSignin"]');
                var contactSignin = $('[name="contactSignin"]');
                var contactConfirmSignin = $('[name="contactConfirmSignin"]');
                var passwordSignin = $('[name="passwordSignin"]');
                var birthDaySignin = $('[name="birthDaySignin"]');
                var birthMonthSignin = $('[name="birthMonthSignin"]');
                var birthYearSignin = $('[name="birthYearSignin"]');

                // Fonction pour vérifier le nombre de caractères dans les champs
                function inputChecker(input){
                    if(input.val() == 0){
                        // Ajouter la class error au input
                        input.addClass('error');

                        // Ramener la valeur de formScore à 0
                        formScore = 0;

                    } else{
                        // Incrémenter formScore
                        formScore++;
                    };
                };

                // Appel de la fonction pour vérifier le nombre de caractères dans les champs
                inputChecker(firstnameSignin);
                inputChecker(lastnameSignin);
                inputChecker(contactSignin);
                inputChecker(contactConfirmSignin);
                inputChecker(passwordSignin);
                inputChecker(birthDaySignin);
                inputChecker(birthMonthSignin);
                inputChecker(birthYearSignin);

                // Vérifier que les champs contactSignin et contactConfirmSignin ont les mêmes valeurs
                if(contactSignin.val() == contactConfirmSignin.val()){
                    // Incrémenter formScore
                    formScore++;

                } else{
                    // Ajouter la class error au input
                    contactSignin.addClass('error');
                    contactConfirmSignin.addClass('error');

                    // Ramener la valeur de formScore à 0
                    formScore = 0;
                };

                // Vérifier si le genre à été défini
                if($('[name="genderSignin"]:checked').val()){
                    // Incrémenter formScore
                    formScore++;

                } else{
                    // Ajouter la class error au label
                    $('.genderLabel').addClass('error');

                    // Ramener la valeur de formScore à 0
                    formScore = 0;
                };


                // Vérifier la valeur de formScore
                if(formScore == 10){
                    // Afficher le popIn
                    $('header aside p').text('Votre inscription à bien été prise en compte')
                    $('header aside').fadeIn(250);

                    // Vider le formulaire
                    $('main form')[0].reset();
                };
            });

        
            
        // Supprimer les class error
            $('input, select').focus(function(){
                $(this).removeClass('error');
            });

            $('fieldset:last').click(function(){
                $('.genderLabel').removeClass('error');
            });

        };
})
