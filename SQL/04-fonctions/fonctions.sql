-- *************************************
-- Fonctions prédéfinies
-- *************************************
-- Fonctions prédéfinies : prévues par le langage SQL et exécutées par le développeur.


-- Dernier id inséré :
INSERT INTO abonne (prenom) VALUES ('test');
SELECT LAST_INSERT_ID();  -- permet d'afficher le dernier identifiant inséré


-- Fonctions de dates :
SELECT *, DATE_FORMAT(date_rendu, '%d-%m-%Y') As date_rendu_fr FROM emprunt;  -- met les dates du champ date_rendu_fr au format français JJ-MM-AAAA

SELECT NOW();  -- affiche la date et l'heure en cours

SELECT DATE_FORMAT(NOW(), '%d-%m-%Y %H:%i:%s');

SELECT CURDATE();  -- retourne la date du jour au format YYYY-MM-DD
SELECT CURTIME();  -- retourne l'heure courante au format hh:mm:ss


-- Crypter un mot de passe avec l'algorithme AES
SELECT PASSWORD('mypass');  -- affiche 'mypass' crypté par l'algoritme AES
INSERT INTO abonne (prenom) VALUES(PASSWORD('mypass'));  -- insère le mdp crypté en base


-- Concaténation
SELECT CONCAT('a','b','c');  -- concatène les 3 chaines de caractères
SELECT CONCAT_WS(' - ', 'a', 'b', 'c');  -- concat with separator : concaténation avec un séparateur

-- Fonctions sur les chaines de caractères
SELECT SUBSTRING('bonjour', 1, 3);  -- affiche 'bon' : compte 3 à partir de la postion 1
SELECT TRIM('   bonjour    ');  -- supprime les espaces avant et après la chaine de caractères

-- sources pour trouver des fonctions SQL : sql.sh