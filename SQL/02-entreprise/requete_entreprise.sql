
-- ouvrir la console SQL sous XAMPP :
--      cd c:\xampp\mysql\bin
--      mysql.exe -u root --password



-- ligne de commentaire en SQL débute par --
-- Les requêtes ne sont pas sensibles à la casse, mais une convention indique qu'il faut mettre les mots-clés des requêtes en MAJUSCULES.



-- *************************************
-- Requêtes générales
-- *************************************
CREATE DATABASE entreprise; -- crée une nouvelle base de données appelée "entreprise"

SHOW DATABASES; -- permet d'afficher les BDD disponibles

-- NE PAS SAISIR dans la console :
DROP DATABASE entreprise;   -- supprimer la BDD entreprise

DROP table employes;  -- supprimer la table employes

TRUNCATE employes;  -- vider la table employes de son contenu

-- On peut coller dans la console :
USE entreprise;  -- se connecter à la BDD entreprise

SHOW TABLES;  -- permet de lister les tables de la BDD en cours d'utilisation

DESC employes;  -- observer la structure de la table ainsi que les champs (DESC pour describe)


-- *************************************
-- Requêtes de sélection
-- *************************************
SELECT nom, prenom FROM employes;   -- afficher (sélectionner) le nom et le prénom de la table employes : SELECT sélectionne les champs indiqués, FROM la ou les tables utilisées.

SELECT service FROM employes;   -- afficher les services de l'entreprise

-- DISTINCT
-- On a vu dans la requête précédente que les services sont affichés plusieurs fois. Pour éliminer les doublons, on utilise DISTINCT :
SELECT DISTINCT service FROM employes;

-- ALL ou *
-- On peut afficher toutes les informations issues d'une table avec une * pour dire ALL :
SELECT * FROM employes;   -- affiche toute la table employes

-- clause WHERE
SELECT prenom, nom FROM employes WHERE service = 'informatique';  -- affiche le prénom et le nom des employés du service informatique. Notez que le nom des champs ou des tables ne prennent pas de guillemets, alors que les valeurs telles que 'informatique' prennent des guillemets. Cependant, s'il s'agit d'un chiffre, on ne lui met pas de guillemets.

-- BETWEEN
SELECT nom, prenom, date_embauche FROM employes WHERE date_embauche BETWEEN '2006-01-01' AND '2010-12-31';  -- affiche les employés dont la date d'embauche est entre 2006 et 2010

-- LIKE
SELECT prenom FROM employes WHERE prenom LIKE 's%'; -- affiche les prénoms des employés commençant par S. Le signe % est un joker qui remplace les autres caractères.
SELECT prenom FROM employes WHERE prenom LIKE '%-%'; -- affiche les prénoms qui contiennent un tiret. LIKE est utilisé entre autres pour les formulaires de recherche sur les sites.

-- Opérateurs de comparaisons :
SELECT prenom, nom, service FROM employes WHERE service != 'informatique';   -- affiche le prénom et le nom des employés n'étant pas du service informatique

--      =
--      <
--      >
--      <=
--      >=
--      !=  ou encore  <>  pour différent de


-- ORDER BY pour faire des tris :
SELECT nom, prenom, service, salaire FROM employes ORDER BY salaire;    -- affiche les employés par salaire en ordre croissant par défaut.

SELECT nom, prenom, service, salaire FROM employes ORDER BY salaire ASC, prenom DESC;   -- ASC pour un tri ascendant, DESC pour un tri descendant. Ici on trie les salaires par ordre croissant puis à salaire identique, les prénoms par ordre décroissant.

-- LIMIT
SELECT nom, prenom, salaire FROM employes ORDER BY salaire DESC LIMIT 0,1;  -- affiche l'employé ayant le salaire le plus élevé : on trie d'abord les salaires par ordre décroissant (pour avoir le plus elevé en premier), puis on limite le résultat au premier enregistrement avec LIMIT 0,1. Le 0 signifie le point de départ de LIMIT et le 1 signifie prendre 1 enregistrement. On utilise LIMIT dans la pagination sur les sites.


-- L'alias avec AS :
SELECT nom, prenom, salaire * 12 AS salaire_annuel FROM employes;   -- affiche le salaire sur 12 mois des employés. salaire_annuel est un alias qui "stocke" la valeur de ce qui précède.

-- SUM
SELECT SUM(salaire * 12) FROM employes; -- affiche le salaire total annuel de tous les employés. SUM permet d'additionner des valeurs de champs différents.

-- MIN et MAX :
SELECT MIN(salaire) FROM employes;  -- affiche le salaire le plus bas
SELECT MAX(salaire) FROM employes;  -- affiche le salaire le plus haut

SELECT prenom, MIN(salaire) FROM employes;  -- ne donne pas le résultat attendu, car affiche le premier prénom rencontré dans la table (Jean-Pierre. Il faut pour répondre à cette question utiliser ORDER BY et LIMIT comme au-dessus.
SELECT prenom, salaire FROM employes ORDER BY salaire ASC LIMIT 0,1;


-- AVG (average)
SELECT AVG(salaire) FROM employes;  -- affiche le salaire moyen de l'entreprise

-- ROUND
SELECT ROUND(AVG(salaire), 1) FROM employes;  -- affiche le salaire moyen arrondi à 1 chiffre après la virgule

-- COUNT
SELECT COUNT(id_employes) FROM employes WHERE sexe = 'f';  -- affiche le nombre d'employés féminins

-- IN
SELECT prenom, service FROM employes WHERE service IN ('comptabilite', 'informatique');  -- affiche les employés appartenant à la comptabilité ou à l'informatique

- NOT IN
SELECT prenom, service FROM employes WHERE service NOT IN ('comptabilite', 'informatique');  -- affiche les employés n'appartenant pas à la comptabilité ou à l'informatique

-- AND et OR
SELECT prenom, service, salaire FROM employes WHERE service = 'commercial' AND salaire <= 2000;  -- affiche le prénom des commerciaux dont le salaire est inférieur ou égal à 2000

SELECT prenom, service, salaire FROM employes WHERE (service ='production' AND salaire = 1900) OR salaire = 2300;  -- affiche les employés du service production dont le salaire est de 1900, ou dans les autres services ceux qui gagnent 2300

-- GROUP BY
SELECT service, COUNT(id_employes) AS nombre FROM employes GROUP BY service;  -- affiche le nombre d'employés par service. GROUP BY distribue les résultats du comptage par les services correspondants.

-- GROUP BY ... HAVING
SELECT service, COUNT(id_employes) AS nombre FROM employes GROUP BY service HAVING nombre > 1;  -- affiche les services où il y a plus d'un employé. HAVING remplace WHERE dans un GROUP BY.


-- **************************
-- Requêtes d'insertion
-- **************************
SELECT * FROM employes; -- on observe la table avant de la modifier

INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (8059, 'alexis', 'richy', 'm', 'informatique', '2011-12-28', 1800);  -- insertion d'un employé. Notez que l'ordre des champs énoncés entre les 2 paires de parenthèses doit être le même pour que les valeurs correspondent.

-- Une requête sans préciser les champs concernés :
INSERT INTO employes VALUES (8060, 'test', 'test', 'm', 'test', '2012-12-28', 1800, 'valeur en trop');  -- insertion d'un employé sans préciser la liste des champs si et seulement si le nombre et l'ordre des valeurs attendues sont respectés => ici erreur car il y a une valeur en trop !


-- **************************
-- Requêtes de modification
-- **************************
-- UPDATE
UPDATE employes SET salaire = 1870 WHERE nom = 'cottet';  -- modifier le salaire de l'employé de nom Cottet

UPDATE employes SET salaire = 1871 WHERE id_employes = 699;  -- il est recommandé de faire des modifications de données par les id car ils sont uniques. Cela évite de'updater plusieurs enregistrements à la fois.

UPDATE employes SET salaire = 1872, service = "autre" WHERE id_employes = 699;  -- on modifie 2 valeurs dans la même requête

-- A ne pas faire (sauf cas contraire) : un UPDATE sans clause WHERE
UPDATE employes SET salaire = 1870;  -- ici les salaires de TOUS les employés passent à 1870



-- REPLACE
REPLACE INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (2000, 'test', 'test', 'm', 'marketing', '2010-07-05', 2600);  -- l'id_employes 2000 n'existant pas, REPLACE se comporte comme un INSERT

REPLACE INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (2000, 'test2', 'test2', 'm', 'marketing', '2010-07-05', 2601);  -- l'id_employes existe, REPLACE se comporte comme un UPDATE


-- **************************
-- Requêtes de suppression
-- **************************
-- DELETE
DELETE FROM employes WHERE id_employes = 900;  -- suppression de l'employé dont l'id est 900

DELETE FROM employes WHERE service = 'informatique' AND id_employes != 802;  -- supprime tous les informaticiens sauf 1 (dont l'id est 802)

DELETE FROM employes WHERE id_employes = 388 OR id_employes = 990;  -- supprime 2 employés qui n'ont pas de point commun. Il s'agit d'un OR et non pas d'un AND car un employé ne peut pas avoir 2 id_employes différents.

-- A ne pas faire : un DELETE sans clause WHERE :
DELETE FROM employes;  -- revient à faire un TRUNCATE de table qui est irréversible


-- **************************
-- Exercices
-- **************************
--1. Afficher le service de l'employé 547
SELECT service FROM employes WHERE id_employes = 547;


--2. Afficher la date d'embauche d'Amandine
SELECT date_embauche FROM employes WHERE prenom = 'amandine';


--3. Afficher le nombre de commerciaux
SELECT COUNT(id_employes) FROM employes WHERE service = 'commercial';


--4. Afficher le coût des commerciaux sur 1 an
SELECT SUM(salaire * 12) FROM employes WHERE service = 'commercial';


--5. Afficher le salaire moyen par service
SELECT service, AVG(salaire) FROM employes GROUP BY service;


--6. Afficher le nombre de recrutements sur l'année 2010 (3 synthaxes possibles)
SELECT COUNT(id_employes) FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2010-12-31';
SELECT COUNT(id_employes) FROM employes WHERE date_embauche >= '2010-01-01' AND date_embauche <= '2010-12-31';
SELECT COUNT(date_embauche) FROM employes WHERE date_embauche LIKE '2010%';


--7. Augmenter le salaire de chaque employé de 100
UPDATE employes SET salaire = salaire + 100; 


--8. Afficher le nombre de services différents
SELECT COUNT(DISTINCT service) FROM employes;


--9. Afficher le nombre d'employés par service
SELECT service, COUNT(id_employes) FROM employes GROUP BY service;


--10. Afficher les infos de l'employé du service commercial ayant le salaire le plus élevé
SELECT nom, prenom, salaire FROM employes WHERE service = 'commercial' ORDER BY salaire DESC LIMIT 1;


--11. Afficher l'employé ayant été embauché en dernier
SELECT id_employes, nom, prenom, date_embauche FROM employes ORDER BY date_embauche DESC LIMIT 1;