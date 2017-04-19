// Attendre le chargement du DOM
$(document).ready(function(){

    // Définir une variable
    var boxChecked;
    var imgSelected = false;

    // UI checkbox
    $('[type="checkbox"]').click(function(){

        // Inverser la valeur de imgSelected
        imgSelected = !imgSelected

        console.log(imgSelected)

        // Définir la valeur de boxChecked
        boxChecked = $(this).val();

        // Décocher les checkbox
            var checkboxArray = $('[type="checkbox"]').not( $(this) )

            for( var i = 0; i < checkboxArray.length; i++ ){
                checkboxArray[i].checked = false;
            };
        
        // Modifier l'image
            if( $(this).val() == 'first' ){
                $('img').attr('src', 'img/1.jpg');

            } else if( $(this).val() == 'second' ){
                $('img').attr('src', 'img/2.jpg');

            } else if( $(this).val() == 'third' ){
                $('img').attr('src', 'img/3.jpg');
                
            } else{
                $('img').attr('src', 'img/4.jpg');
            }
        

    });

    // Capter la soumission du formulaire
    $('form').submit(function(evt){

        // Bloquer le comporetement par defaut du formulaire
        evt.preventDefault();

        /*
            - Vérifier quelle checkbox est cochée
            - afficher une modal avec l'image sélectionnée
            - Réinitialiser le formulaire
        */
        
        if(boxChecked == undefined){
            console.log('Vous devez choisir une image');

        } else{
            // Afficher la modal
            $('#modal').fadeIn();

        }






    });

});