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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpressuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'AMcom20anos' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '4TvXEjixm8{Qt-6j:.e.h-!|_D39{-^s{jm|?RD-2Y^:F=J*_nk;P>4gu&UGO>Y{');
define('SECURE_AUTH_KEY',  '(^*>|6Pe.& g[R}vi~&;rW>Y)&yEW,-hJC]Ip$huA:*.R[SHN>^`Aj{]noJo3vM<');
define('LOGGED_IN_KEY',    '^~,g,~s||)&@8}EQa +P?Bw5]BJN~e,i}MqS <h-BK*a*2VlLKaN+>%Zf1F^4cDu');
define('NONCE_KEY',        '#E[u% i .TdEtdTC:P,gdv<hH{hBm8ptz};^&:tWgO*?|GE3u1aFckGIlv={Pm&K');
define('AUTH_SALT',        '!fe?V&i|Tg6TCEGe_i^I]N*M_&:9Vj,H!yl)p1{EI}8yuNFI|;9NVQ(&o(YVcShm');
define('SECURE_AUTH_SALT', '!$3[Kv)L^[U4JF#^5bC/(Rm>zZKm-dmX^i$3S[V ,Le+myKGOi!@BIx_#8tCW^+4');
define('LOGGED_IN_SALT',   '3$W:p7x&^|9XIS5GG>6ZW}pzQ(]LSZ$6?-[9!P(k0iI:j~Sxq(Bw!s+F8?4McK)^');
define('NONCE_SALT',       'P`H}-vwm:Bdb^7M-5Iz[p4X{<fCM1;l+Elc~AoWYrqASQ/:{odGL7E8n):%[%|f=');

/**#@-*/

define('FS_METHOD', 'direct');

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
