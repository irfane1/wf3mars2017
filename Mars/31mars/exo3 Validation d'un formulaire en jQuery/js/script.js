// Attendre le chargement du DOM
$(document).ready( function(){


    // Capter la soumission du formulaire
    $('form').submit(function(evt){

        // Définir une variable pour le score du formulaire
        var formScore = 0;

        // Bloquer le comportement naturel du formulaire
        evt.preventDefault();

        // Connaitre la valeur saisie dans le input par l'utilisateur
        var userName = $('input').val();
        // Connaitre le nombre de caractères dans la valeur
        console.log( userName.length );

        // Connaitre la valeur saisie dans le textarea par l'utilisateur
        var userMessage = $('textarea').val();
        // Connaitre le nombre de caractères dans la valeur
        console.log( userMessage.length );


        // Vérifier la taille de userName (min. 1 caractère)
        if( userName.length == 0 ){
            // Afficher un message  dans le label
            $('[for="userName"] b').text('Champ obligatoire');


        } else{
            console.log('userName OK');
            // Incrémenter formScore
            formScore++;
        };

        // Vérifier la taille de userMessage (min. 5 caractères)
        if( userMessage.length < 4 ){
            

        } else{
            console.log( 'userMessage OK' );
            // Incrémenter formScore
            formScore++;
        };

        
        // Vérifier la valeur de formScore pour valider le formulaire
        if( formScore == 2){
            console.log('Le formulaire est validé !')

            // => Envoyer les données dans le fichier PHP et attendre la réponse du PHP (true/false)
            
            // Le PHP répond true !

            // Ajouter le message dans la liste        
            $('section:last').append('<article><h4>' + userMessage + '</h4><p>' + userName + '</p></article>' );

            // Vider les champs du formulaire
            $('input').val('');
            $('textarea').val('');    

        };

        // Supprimer les messages d'erreur
        $('input, textarea').focus(function(){

        $(this).prev().children('b').text('');

        });

    });


    
}); // Fin de la fonction d'attente de chargement du DOM