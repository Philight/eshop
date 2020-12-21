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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dbeshop' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Utm==1C.krh->k o2GuPX`%SNmd/Rzj^Uw&?@0<G>lp ?.gY6)o)tD*NXffVc=`W' );
define( 'SECURE_AUTH_KEY',  '<G0UMWlF6iLJk^#]R1@-lic7ZGRaq9 ^F:RwhGvNv!kfw{; QpD/LHqVUG){+q+y' );
define( 'LOGGED_IN_KEY',    '4A,jQ{hv)N~l7L!&+=-(JI73/sQCKi;%*uJLdoW1/e}D[L<SskAX7.g,I#+=yN?i' );
define( 'NONCE_KEY',        'TGHjE~}hn6cLYk5kpU}y8XCLv%^,g!-Oh =?M k4/0H6u.9%!C(R?UB|B.. _e 4' );
define( 'AUTH_SALT',        'wK@[(hY[yarfI4wim{z6-qQ5;v.<kC{[)L9l`n+2{^!Xy~; dg*_U1Sknw/gy&/Q' );
define( 'SECURE_AUTH_SALT', '&NHBLXAs:],t&l+Zve2qfyJZY7Lp~rsaRf(po6>L!~HX!J#vak@osBFBKk!r`?J4' );
define( 'LOGGED_IN_SALT',   'g,YTqJ&)-#W.Bop2`hWv)0?*<HeS+c@VzQByfW}$.; !DPggoyuiDF( +DbZ^C_i' );
define( 'NONCE_SALT',       '|rI8vyA}b+0:&U*2Zxa_LCX[XK kF(Q8X]a:| f`L/)uQ*tNIVF@~{)*vaJY0/<-' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
