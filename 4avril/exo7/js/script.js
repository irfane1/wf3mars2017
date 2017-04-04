$(document).ready(function(){

   // Capter le click sur le premier bouton
   $('button:first').click(function(){

       // Charger le fichier home.html dans le main
       $('main').load('views/home.html');

   });

}); // Fin de la fonction d'attente de chargement du DOM