<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'cinema');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6Fn%?FSN+1U}Lut~5dj?uZzbtP!o}4O@&MV%~x4YNm96bue31ZKV2IQf^l$.]lDL');
define('SECURE_AUTH_KEY',  'jlNNFRGcS&emA9!h`G!*NSUd51-Zw]/2 RTh!Q.mX9_-7s@w|0Q#getyCUIh%JM9');
define('LOGGED_IN_KEY',    'Yy?lH)L4`w7E!esi+dL#qX-q2@uhmm*kQQrw1Q8=Ua$>Nx0fYX6eL16SP.A+:h._');
define('NONCE_KEY',        '->+ >rbh9m{J!D3tQG-7pz-- B>_E}.C%cD20oEBkL{-AJJ/,IqFz[7}.gopWhx~');
define('AUTH_SALT',        'glhPdZ`-z8)WV3CK{-srE0e,U;az{ciiK0ycV&zX6e[lwmta6K?&0L&cbPFN0lvO');
define('SECURE_AUTH_SALT', 'ay)5oF7,d]Anm?;}PgGf?Q72>%ii2eiJY#/m$N:sYP~d`{ohPt<8/^uZ@>qH J;j');
define('LOGGED_IN_SALT',   'yw+oE4AZ*+T8vJi+Ir^p*cE[1`3pZJ_1t,56n1VPtWm,B>[yMUJ*&sEto[,o{~s0');
define('NONCE_SALT',       'R|2j{N_7UZ1W^u.2lP3pN^N1T;9BS|U}2BP$!zG~)sZ^|}7<_CXq9hqd@YF^]j)P');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');