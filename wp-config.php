<?php
//define( 'WP_SITEURL', 'http://blog.ninja11.in');
//define( 'WP_HOME', 'https://blog.ninja11.in');

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'blogs' );

/** MySQL database username */
define( 'DB_USER', 'blog' );

/** MySQL database password */
define( 'DB_PASSWORD', 'blog#DB2021' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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

define( 'AUTH_KEY',         'wweO}I98x~qJJ(qkx]ve|:>xyK8Feu>6rH)_uGJUW}asEskZ6SCxTe$`Im8OD^@$' );
define( 'SECURE_AUTH_KEY',  ',AP@.%QE|!?nr7]`1)k0|OsK2wG19amgd>h~aK$?>I9J+h#6J0wP1jz JwZ)oO;h' );
define( 'LOGGED_IN_KEY',    '~ey&Xk?C>CNrveTRpI9q=gAIs^=I%.GZ<f~5RVW48z#[4%+IOW-GH!g#BK-&^0yq' );
define( 'NONCE_KEY',        '32`9<Rz(c,S0iWg0Yhz84/1;ER~j|pG^^$zAT6[R^2Qr>ni/j<x=R|R~NOh_9wNV' );
define( 'AUTH_SALT',        'gAT(vPE~_G*E<b{lWM8I>&|kgu%}@^HDzm}hos):(+bqRH3}}&9WaT5^1je)!)U*' );
define( 'SECURE_AUTH_SALT', 'n-%}bAw+Z:@VG:MTw[3/)~U[p@et3J=|2oB?i_$fOQ@}dae[0*Ro4IqF_JXWc_#W' );
define( 'LOGGED_IN_SALT',   'Ajkq55@>&(gpoIj:7Mi# R+,tkl-}cT[G<~T,Rd_JqWt/&hwQyyx<h(6$e4wlpD}' );
define( 'NONCE_SALT',       ',ZYE%bZkO?GU,ktJEZZx#J+F$X_g}}SE9-|dq`yq:d% nO-zJ}J#0]e2@=y],A.*' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'n11_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
