<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


define('WP_AUTO_UPDATE_CORE', false);// This setting was defined by WordPress Toolkit to prevent WordPress auto-updates. Do not change it to avoid conflicts with the WordPress Toolkit auto-updates feature.
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_3');

/** MySQL database username */
define('DB_USER', 'wordpress_0');

/** MySQL database password */
define('DB_PASSWORD', 'zyQw&091');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         's4 Z|Gmi~S2lh00JRyDzYAT9S;4GkH&$16QfyUF$U%M=:+/7H/@:YM9u~}5CqCi$');
define('SECURE_AUTH_KEY',  'XXcg_z{=kH5%bLCNvve!R/{9PSE!MpmGp3hH,niqJRHn)}aTVt/rpoI XZoyx$~#');
define('LOGGED_IN_KEY',    '@s*zd_:H#|Vmb6]^Y?@O:8VRGThN1~t:O+#i#7jcU;I-3-u9D:@W[$,e?IDH?mAE');
define('NONCE_KEY',        '5U8gNh{a$isrH#Lty)!jX0xN]~pu.*S%DveS#Qcw/0JI5H Zczb~L`?IbDNe1{F5');
define('AUTH_SALT',        '<8>wuc;k~/M{uH$G*)S[gDTnF_Cu)jWEcw<g$1N&La`aaFO#V)&/E4;f`orJA(vn');
define('SECURE_AUTH_SALT', 'c5,x+^jY3:[Q==C>u:$n(uDZ+~)8(L<:3 GkjcziU@p(*E8VYiTvB/<zP|i0.n@n');
define('LOGGED_IN_SALT',   'VEK?wgt4W~7j#kqvo:qbPt~@YPN.Z.U,s~z44*WzL3ru/f)G^U[+L=89wPb_R_P9');
define('NONCE_SALT',       '@Bu)m% :9+D|&~ZpBCVq+6qg^IZG>>]FAUxtqC5)nWmHlP$C5mf.k|au:VE2.j]o');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'a02_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
//define('WP_DEBUG', true);

ini_set('log_errors', 'On');
ini_set('error_log', 'wp-content/php-errors.log');
//error_reporting(E_ALL);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
