<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hirerex_sc6ik2');

/** Database username */
define('DB_USER', 'hirerex_ipzky');

/** Database password */
define('DB_PASSWORD', '%OD@0;M73cRT');

/** Database hostname */
define('DB_HOST', 'localhost:/var/lib/mysql/mysql.sock');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'c>F+CVp2w1r[t8g;T+Bd8^ko> $*zF*09l|7Q00&AFB(j>6_]I-(k+yl:5[dg>~o');
define('SECURE_AUTH_KEY', 'PPH_xYaY2Pk]#6KaB2glr:QOadYoJZ/w+{&7#RU+$g0,XWk^kLrJ^<X=i(Mm9h=g');
define('LOGGED_IN_KEY', 'a238AOp |kL(uHRl: JxuL 6+$-r-Eu6/+O drPs0GWmqQ]Cw?p;EXfF`!x+|r|&');
define('NONCE_KEY', '?_+ -Gy2m3&2b|M=lQEHrc>aYZsKpw1VGdk-QS60D!zCb!#o~Nd;B[2!2.l<]r);');
define('AUTH_SALT', 'yFr1<r<{es ,;Pi9K,nnU#w)g[hDo7{kx9S]A2+CE6bHyc-U%+7;QUhQ%#E/f-@B');
define('SECURE_AUTH_SALT', '|Hnnrs.cuQ-#f2v }H7Ld|Zp-AyN>P]=Zn )(a8r4TR8|9_V+9Rzu_U-Xa?*(Yl:');
define('LOGGED_IN_SALT', 'jJp2g(p5jcVJsKOrCms^J{W65%6_4pu<-*/ddNCtCE&=M}ZF>4OT|/%U-D4H-Wo>');
define('NONCE_SALT', '?dE$r0==mR0< 3HmVmZi,-fd|3mDlbIr33 (Vv*9`io%-_-j_s~{|3Vx{9!lbK?B');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('DISALLOW_FILE_EDIT', false);
define('DISALLOW_FILE_MODS', false);