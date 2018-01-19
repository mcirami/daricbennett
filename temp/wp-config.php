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
define('AUTH_KEY',       'L9tR%UzNfv23z@U1y4ngR3&UhQ!74@@X6YVtP#y)TwHgQqwY4BjrqZNf5N&&bhdk');
define('SECURE_AUTH_KEY',       'phbxi)20mxJpZYTKeB@yZ7XZ3OGUJxEUCx@AYC3LKRJUsY*kgg(Pi&Q9Yj3c82zt');
define('LOGGED_IN_KEY',       'p6KETgV&as%ndjhJ%taBIDQ^P*q6Mg^vGf*H&cDV#lrvomBlGEXd9KC2u6c87%L0');
define('NONCE_KEY',       'P4cA)dihuaBS0lU(hM%0Y3%5B5pZn(EDB8jR&wWqtD(JC*b&o#yeFIp18WnnIBVd');
define('AUTH_SALT',       'A534%QEs%t317UYRUL(bC1V#LKyy8kk75vd)1aLJ0P1W9^8wEfspWJtkh)VfQBxn');
define('SECURE_AUTH_SALT',       'ueJvrvQUZ^fXAeua&Vb&^eWyr0K&1sjeYL(mdCQS5au)jX6H!Q*AfRkVt(QJx@Xm');
define('LOGGED_IN_SALT',       'u^rZWRs8wxY@)5yYGHXRM4bF9yLVxZgnTAqV^JZBlGMW4*HwF4i@)C9y6eUYC9cH');
define('NONCE_SALT',       'oN%y4Ch(DIWzOr0FxZJQLA2CzC7E3tnbv*&^u6nh*10*GloqVcPcL8ROdk(HiOY(');
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