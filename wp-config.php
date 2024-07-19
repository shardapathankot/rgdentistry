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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
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
define( 'AUTH_KEY',          'zg56_w}=/P0f.b,mq6*+!BKvebT9?t~Q1Ulv<$1cB`cw#MyL,-,JcSkoJ:S[nyag' );
define( 'SECURE_AUTH_KEY',   ')?@NhA.m:|E>V&}AQ4$6!Q1I>&CFpC.h$Sk^-i3(7.YWaXh&sGH!FSnytKhew`|E' );
define( 'LOGGED_IN_KEY',     '3;69 L3:]{g<@.ed5%D*$3KvApP]Y9^24_8oSV?,+SvUc{BBjlfUMij9QPP8G*`I' );
define( 'NONCE_KEY',         'pV!Nr8HW&9e8&T[4j#1&<IGi_)VG0|.f7r:,P|c+ox9od) ~sRuvy*_~K0/jT`~z' );
define( 'AUTH_SALT',         '}TKGQF:n),R(}L`K#a& =S.JlCf)X2mCISeb.2I:0GIZG3-;hsQ#C(^@QlO:Px4-' );
define( 'SECURE_AUTH_SALT',  '!9T+UUGVO%~ :>,u!g@m9_oJg#D{@r]v[o{^/kVie`n]n^OX9?}*4<Cee)GgX7b`' );
define( 'LOGGED_IN_SALT',    'A2?OB_C0Yz=CJ?rS+W1FFz>.bHLm^GW~9glG$<?(FIn]+wI}>#qW{Ey< 1n^{x#Q' );
define( 'NONCE_SALT',        'LXeDp EE}.[-MV8fjF7,.~4buz(C~J5)|xmh1!8c=2F5wT|H[w.N}gVser&~Oo{*' );
define( 'WP_CACHE_KEY_SALT', 'Nif1-v_/uR?+M*ecRGy9x:$m}G:f9iU#xpnT+`?KAVip;+!U:Lc*saQWzch%Qvn#' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
