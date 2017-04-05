$(document).ready(function(){

    // Capter le clic sur le premier bouton
    $('button:first').click(function(){

        // Charger le contenu de views/about.html dans la première section du main
        $('section').eq(0).load('views/about.html', function(){

            // Fonction de callBack de la fonction load()
            console.log('Le fichier about.html est chargé');

            // Animer la première section
            $('section').eq(0).fadeIn();

        });

    });


    // Capter le clic sur le deuxième bouton
    $('button').eq(1).click(function(){

        // Charger dans la deuxième section le contenu de l'id portfolio de views/content.html
        $('section').eq(1).load('views/content.html #portfolio');

    });

    // Capter le clic sur le troisième bouton
    $('button').eq(2).click(function(){

        // Charger dans la troisième section le contenu de l'id contacts de views/content.html
        $('section').eq(2).load('views/content.html #contacts', function(){

            // Appeler la fonction submitForm
            submitForm();

        });

    });


    // Créer une fonction pour capter la soumission du formulaire
    function submitForm(){

        // Capter la soumission du formulaire
        $('form').submit(function(evt){

            // Créer une variable pour la validation finale du formulaire
            var formScore = 0;    

            // Bloquer le comportement par défaut du formulaire
            evt.preventDefault();

            console.log('Submit du formulaire');


            // Minimum 4 caractères pour l'email et 5 caractères pour le message
            if(
                $('[type="email"]').val().length < 4
            ){
                console.log('Email manquant');

            } else{
                console.log('Email OK');
                // Incrémenter formScore
                formScore++;
            };

            if(
                $('textarea').val().length < 5
            ){
                console.log('Message manquant');

            } else{
                console.log('Message OK');
                // Incrémenter formScore
                formScore++;
            };

            // Vérifier la valeur de formScore
            if( formScore == 2){
                console.log('Le formulaire est validé !')

                // => envoi des données vers le fichier de traitement PHP
                    // => le fichier PHP répond true : je peux continuer mon code

                    // Ajouter le message dans la balise aside
                    $('aside').append('<h3>' + $('textarea').val() + '</h3><p>' + $('[type="email"]').val() + '</p>');

                    // Reset du formulaire
                    $('form')[0].reset();

            }


        });

    };

    










});