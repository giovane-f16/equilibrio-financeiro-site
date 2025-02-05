<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u896954122_a16nw' );

/** Database username */
define( 'DB_USER', 'u896954122_dNrBY' );

/** Database password */
define( 'DB_PASSWORD', 'iabqcxfQkP' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          ';&lLqG{Z+w^#MxiZj#?:LeXb2:Lg`rDgyo?U]1i<#V:}M0BHG<_{P6Ty:nm|IL)g' );
define( 'SECURE_AUTH_KEY',   '=U=,_bCi!]_o|}IaO<R]-5l/yl0og`1PeUhdW_tIY%`?+ZbMD|HRxF_OPKg_yW;(' );
define( 'LOGGED_IN_KEY',     ',r=2/vOZ1>$|]$5zf1)[Nk&3w~7,3+$;!;k5<rFH*b+Q]LC/g<N0|[)v,,(3|c5Q' );
define( 'NONCE_KEY',         'KW$V-ocWG62F<cRT21Zh*U!<7*1]e^3tQEsu~8ZW2_5{g`5gz!]Q4DoE<6Nc=p^E' );
define( 'AUTH_SALT',         'K|nV1X(NacH]Db0%-JX}ae`xhyFG@yxfRrKp(jy[Fu}ePm@{XAR#0{J#gME!j?C6' );
define( 'SECURE_AUTH_SALT',  'zcc>jN%wPw@(atg`KSSfwH |5X5R)NLr%`aA.5{fHE3l/dW^@UDxBxOO_}PXV`,f' );
define( 'LOGGED_IN_SALT',    'E)2zdPYh=nH65_B5$tY7j~x?19WJg?R Xk3US`@}DxvO>Q_/Q8A~rRe|H4$N|[tS' );
define( 'NONCE_SALT',        '$nMiCZXFT%ZRpWbeGV|z$VGNvWXYDt{@VX|LDr{.+Yta7s|zAONFxJh<Mo{_{_V4' );
define( 'WP_CACHE_KEY_SALT', 'W;)1ox;e8ugAb~R|_MZ2^gR<)u&FsLTAeTn^PN&ZcYP8(sMq Z*I(Y<o)+pZ9J^&' );


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

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '4cfd202a2b29d007bc83f063639216ee' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
