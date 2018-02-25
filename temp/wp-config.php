<?php


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
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/vhosts/daricbennett.com/httpdocs/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'jeffimec_a02');

/** MySQL database username */
define('DB_USER', 'jeffimec_a02');

/** MySQL database password */
define('DB_PASSWORD', 'g3X4y9v_SE');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',       '%8Hc#@i@A1OOw7DeqGQdTIDFebjRJLxdY5iEAz%nRP8)uuT1g*!OtdHM3pBkX63P');
define('SECURE_AUTH_KEY',       'IqQgfaYQaP%sI9T6PI@DZU2K!9fM&#ri7HFVXmcAqF7i%t%S9(0KsknTHcxrl7B@');
define('LOGGED_IN_KEY',       'iDA3ZfN8vCtOTpCu^jB(KzZ#cA)jH763EatPvmcCr(0!jxjHlV56U0#j@rkJ14ke');
define('NONCE_KEY',       'R87h2qxHzgv1Ss7JKjcdeTZpqmklK55NW*x5hW9gX8Wdw#IC0bt&0QpJSBOf*gsX');
define('AUTH_SALT',       '*jaq7cDnFReOhTPVltY#(7&DA&wXHBcNMzy%cx*KW9s@oaNg8Gt&0!b6%i(n1ExP');
define('SECURE_AUTH_SALT',       '5!MFm5TeiGI%x8DYFNF%F!Uk2KRaGdX^5r#fM8foPGq@jI2N76iDGDwmKyRWFMXg');
define('LOGGED_IN_SALT',       '68)GkUowqFhoBr5LTlOUPxowC6jSoJvkFP&rpJt#kUoS0g0oJptBzKu#LzFBXLwg');
define('NONCE_SALT',       'M&y81ToSD(z8*z7R)entv3QM#%r)9vzpde83tYnWpSY%&7imOqzCtyXAezm#Wp%P');
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
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
ini_set('log_errors','On');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG_LOG', true);

/* That's all, stop editing! Happy blogging. */


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');

define( 'WP_AUTO_UPDATE_CORE', false );

?>