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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/vhosts/daricbennett.com/httpdocs/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'jeffimec_a02');

/** MySQL database username */
define('DB_USER',       'jeffimec_a02');

/** MySQL database password */
define('DB_PASSWORD',       'g3X4y9v_SE');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',       'yvzJlFpIotzA^0wCtaVZndQbOYy6ptMYw(i94HTegsXp9Uugu1f&wLYtK7DLdncA');
define('SECURE_AUTH_KEY',       'O6Bz7YtNlZesaNe2P3nzd0QwsSW9&Qb&rDwXYvu5iMBAf@m0nb%iOHCK0SuwXc03');
define('LOGGED_IN_KEY',       'qwvC3aMBkdMUf8s%d4bbqbIr&LNzSGhURj7x!kbQpr@rqYSnaWDUgABUXZi7Um!P');
define('NONCE_KEY',       'Lutk5y)jnu^IV#VE1u)tx#O5go1O*n!s03ZHlhmskV0a%L4I(0O2rcZKT4Ge8*ot');
define('AUTH_SALT',       'FkDoV1pFn9T6*!oV7b3MbYBeU!!cWn(Jr6(sVVaWO6s3RlHkYUhil5hU(z!3EIq3');
define('SECURE_AUTH_SALT',       'cLdYvtzzVFqRS!tFXIvncCAWX15r4L(oxD@lQMjTLa@%Ev5J)FFHBHbew5r)kD#K');
define('LOGGED_IN_SALT',       'T9t9y0P7jLLo&@vL#ggQHHw!*Vp0zolsXYEZAw@P&DXkV&mgsmKfhfKjpo#oy1(J');
define('NONCE_SALT',       'fX1&aapuht^qJ9u(VcASkXKthZ6gZ3w#B8rXJadlxPW@YcyzZi^DEf0&DlTwcW0L');
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
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
ini_set('log_errors','On');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );

define('WP_HOME','https://daricbennett.com');
define('WP_SITEURL','https://daricbennett.com');

/* That's all, stop editing! Happy blogging. */


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');

define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.

?>
