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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         ':xtpRu-0x%<x^V8|^{+dDOPp+Wq!+>?^X<hPg{#)Sp.q=r|%q,5UKZmxP-sxQ8Wm');
define('SECURE_AUTH_KEY',  '|x&]Ov yZCE3et.l*}1 k+y#}_j/E3n%{OnfJz6|cM^kpMSeqL~Owd 0uArZ2Sf%');
define('LOGGED_IN_KEY',    '<V&70k&OF{meN-nA. uKEirxv]q`#xjySb:CAXpbCa[F,h8_RdL0u}0|3r2%-7_-');
define('NONCE_KEY',        'm.jdhX:,Tg2q2?k_1Z: 2v.~fb`nb.1W3KruN zpk2D-0E-6=qh:^TkbckiFu_B7');
define('AUTH_SALT',        'yx4M+V1+p8@mH=e%ggonL?chGQ&R^9 Rn+*{8WY0d&Z3e0u>r)XMu6|-cbK~z?=n');
define('SECURE_AUTH_SALT', '&]P98k.<=4|wrnoV| R(`i,>B,C[A_NqHyIERl}rnoKSjS)j^uo/Y<%*q_OE8r]Z');
define('LOGGED_IN_SALT',   'HyG@u7wgrTTJ2z(@[{I<Ypg%R,8Zy4jG{S d@x@_!1q9N2e2>q|w3t)a1A7#pw7!');
define('NONCE_SALT',       'LL,!?dK0Sm?DE6-~o[-ip(j{T(Lk-S|Jvr=E@ +Ah3z8w,v/_:aBTKw(Eq/eqk`_');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

define( 'DISALLOW_FILE_EDIT', true );
