// Attendre le chargement du DOM
$(document).ready(function(){

      // Capter l'événement change() sur les selects
        $('select').change(function(){

            // Modifier l'image
                if( $(this).val() == 'null' ){
                    $('section:first-child img').attr('src', 'img/chat_0.jpg');

                } else if( $(this).val() == 'sushi' ){
                    $('section:first-child img').attr('src', 'img/chat_1.jpg');

                } else if( $(this).val() == 'maki' ){
                    $('section:first-child img').attr('src', 'img/chat_2.jpg');

                } else if( $(this).val() == 'sashimi' ){
                    $('section:first-child img').attr('src', 'img/chat_3.jpg');
                    
                } else if( $(this).val() == 'yakitori' ){
                    $('section:first-child img').attr('src', 'img/chat_4.jpg');
                
                } else if( $(this).val() == 'onigri' ){
                    $('section:first-child img').attr('src', 'img/chat_5.jpg');
                }

        });

        // Capter la soumission du formulaire
            $('form').submit(function(evt){

            // Bloquer le comporetement par defaut du formulaire
            evt.preventDefault();

            // Supprimer les class error
            $('select, textarea').focus(function(){
                $(this).removeClass('error');
            });

            // Définir les variables
            var chooseCat = $('select');
            var userMessage = $('textarea');
            var formScore = 0;

        

        // Vérifier que l'utilisateur a bien choisi un chat
            if( chooseCat.val() == 'null' ){
                // Ajouter la class error sur l'input
                chooseCat.addClass('error');

            } else{
                // Incrémenter la valeur de la variable formScore
                formScore++;
            };

        // Vérifier que l'utilisateur a bien saisi au moins 15 caractères dans le message
            if( userMessage.val().length < 15 ){
                // Ajouter la class error sur l'input
                userMessage.addClass('error');

            } else{
                // Incrémenter la valeur de la variable formScore
                formScore++;
            };

      


        // Validation finale du formulaire
            if(formScore == 2){

                $( "form" ).fadeOut('');
            } else{ 
                $(document).write('hdifsdu').fadeIn('Merci !');
            };



        

                // Envoie des données dans le fichier de traitement PHP
                // PHP répond true => continuer le traitement du formulaire


    });

    

}); // => fin d'attente du chargement du DOM