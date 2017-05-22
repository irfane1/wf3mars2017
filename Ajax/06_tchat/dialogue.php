<?php
    require_once("inc/init.inc.php");
    if(empty($_SESSION['pseudo']))
    {
        // si l'utilisateur est déjà présent dans la session, on le redirige sur dialogue.php
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <div id="conteneur">
            <h2 id="moi">Bonjour <?php echo $_SESSION['pseudo']; ?></h2>
            <div id="message_tchat"></div>
            <div id="liste_membre_connecte"></div>
            <div class="clear"></div>
            <div id="smiley">
                <img src="smil/smiley1.gif" alt=":)" />
            </div>
            <!-- FORMULAIRE -->
            <div id="formulaire_tchat">
                <form id="form">
                <textarea id="message" name="message" rows="5" maxlength="300"></textarea>
                <input type="submit" name="envoi" value="envoi" class="submit" />
                </form>
            </div>
            <div id="postMessage"></div>
        </div>
        <script>
        /* var test = postMessage;
        console.log(test); */

        // faire en sorte que si l'utilisateur appuie sur la touche "entrée", cela enregistre le message
        // code de la touche "entrée" => 13
        document.addEventListener("keypress", function(event) {

            if(event.keyCode == 13)  // => touche entrée
            {
            event.preventDefault();
            var messageValeur = document.getElementById("message").value;
            ajax("postMessage", messageValeur);
            ajax("message_tchat");
            document.getElementById("message").value = "";
            }
        });

            // ajout de :) dans le message lors du clic sur le smiley
            document.getElementById("smiley").addEventListener("click", function(event) {
                document.getElementById("message").value = document.getElementById("message").value + event.target.alt;
                document.getElementById("message").focus(); // focus permet de remettre le curseur

                // document.getElementById("message").value = document.getElementById("message").value + ' <img src="'+event.target.src+'" :> ';
                // document.getElementById("message").focus(); // focus permet de remettre le curseur

                console.log(event);
            });

            // pour récupérer la liste des membres connectés
            setInterval("ajax(liste_membre_connecte)", 3333);

            // pour récupérer la liste des messages
            setInterval("ajax(message_tchat)", 2000);

            // Enregistrement du message via le bouton submit
            document.getElementById("form").addEventListener("submit", function(e) {
                e.preventDefault();  // on bloque le rechargement de page lors de la soumission du formulaire

                // ajax("postMessage", message.value);

                // on récupère la value
                var messageValeur = document.getElementById("message").value;
                // on envoie notre ajax pour enregistrement
                ajax("postMessage", messageValeur);

                // on envoie une autre requête ajax pour récupérer les messages et les afficher
                ajax("message_tchat");

                // on vide le champ
                document.getElementById("message").value = "";

            });


            // FERMETURE DE LA PAGE PAR L'UTILISATEUR
            // on le retire du fichier prenom.txt
            window.onbeforeunload = function() {

                var pseudo = '<?php echo $_SESSION['pseudo']; ?>';
                console.log(pseudo);
                
                ajax('liste_membre_connecte', '<?php echo $_SESSION['pseudo']; ?>');
            };






            // déclaration de la fonction ajax
            function ajax(mode, arg = '') {
                if(typeof(mode) == 'object') {
                    mode = mode.id;
                    // l'argument mode recevra les id des différents éléments de notre page. Sachant que l'on peut sélectionner des éléments HTML directement par leur id (sans getElementBy...) il y a un risque de récupérer un objet représentant l'élément HTML. Dans ce cas nous récupérons juste l'id de l'élément (mode = mode.id)
                }
                console.log("mode actuel: "+mode);  // nous affichons la tache en cours dans la console

                var file = "ajax_dialogue.php";
                var parametres = "mode="+mode+"&arg="+arg;

                if(window.XMLHttpRequest) {
                    var xhttp = new XMLHttpRequest();
                } else {
                    var xhttp = new ActiveXObject("Microsoft.XMLHTTP");  // IE < v7
                }

                xhttp.open("POST", file, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function() {
                    if(xhttp.readyState == 4 && xhttp.status == 200) {
                        console.log(xhttp.responseText);
                    var obj = JSON.parse(xhttp.responseText);

                    document.getElementById(mode).innerHTML = obj.resultat;

                    var boiteMessage = document.getElementById("message_tchat");
                    document.getElementById(mode). scrollTop = boiteMessage.scrollHeight;
                    // permet de descendre l'ascenseur de ce div et de voir les derniers messages

                    }
                }
                xhttp.send(parametres);  
            }

            // var truc = message_tchat.scrollHeight;
            // console.log(truc);
        </script>
    </body>
</html>