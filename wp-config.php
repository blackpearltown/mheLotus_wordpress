<?php
define('WP_CACHE', true); // Added by Speed Booster Pack


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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Y0u@ren0tW0rthy' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         ':[dnC  ?ZfC~Z,Zcqe@]xq>|e::7~*w4^%r}+jk[4xt%~a[C9U8E]%=XX;Na;}=w' );
define( 'SECURE_AUTH_KEY',  'W8TdoxW|#h[TW2`P,ZZ!YRWAN8Ll~FFuscZpl>IU~Yn$j@v8Bmq*3s(]v^QY{5yf' );
define( 'LOGGED_IN_KEY',    '&;c#rI~no*Zl:Je)C?ka /Y|z#oh=Q>V3vcq>@+:B fr5&U!UdV[ P;8Z#uU!t8#' );
define( 'NONCE_KEY',        '7:pF*W|C5[6PM<Q6yDe6a(H)K<]X{fT`_yI6Ef1=){$6!r.$/.(lma<JA=CJ#!kQ' );
define( 'AUTH_SALT',        '>(FQmx$5Koi=)TKCs^[D*+g3?v,-)_G4j{J;!{!$XZdX~(O+x*N/Y5y *VF-G2p[' );
define( 'SECURE_AUTH_SALT', 'MUUv0Gx U1aNgGtmOLY.&d7@&Z$tnb1j-n;tx=&Ri4;x<F|o0>@ak;-6;/I2H> P' );
define( 'LOGGED_IN_SALT',   '^gd,$^aA:`02 *0Z+uF9xWnz)EBG#Mts%h&6GoYP[xuMAn?6D3R<[#iGQcb<&,n{' );
define( 'NONCE_SALT',       'k_d5+)eDz46_HHT.?=5o8M1B^}WE:i&&mj62h0.;u33dpJC(PM<n_o!j}tf9. Kz' );

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
define( 'WP_DEBUG', false );
define('FS_METHOD', 'direct');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
