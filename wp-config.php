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
define('DB_NAME', 'new_sebpo_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'a0{cR=N71(3Dw }/Sj-|<xJ)k-Rr4CHqCWy95LP?WunFg3a=7S[p#E0(Rc~D-N2N');
define('SECURE_AUTH_KEY',  'gu$-St%aHpOx4]Q7mFeQ Had)}:0a1$Q4n7)y6B#lcaY(4t^8a,ZzKM)L&I{ZlN~');
define('LOGGED_IN_KEY',    'sr@^|wc6}]DzOE=fgSYui`:j^]Xah,zQSJGcF]]5>P>2rf-biHQ4C9:!T7a(]H3#');
define('NONCE_KEY',        'ieWvqO1lNjzgkS4J3EGZk(t+Gs-*RXEzyT~xBcMk28_IdyYIHcIGf8g_#3?}?zCj');
define('AUTH_SALT',        'lb%64<!X_i^aeOJ8BHe#$0#*v)]IAoWfsR+f7RV>`eg~dzHIhI$y #5mD`#Y96-/');
define('SECURE_AUTH_SALT', 'i[TK:1xzOC@8 { [+~j_]X3-xq<!e9~HjFD;12u.:F*Ly}/0z0P`r~aG.e4QKA+n');
define('LOGGED_IN_SALT',   'A)jIc8}Y7vr|s]`DuO5JNa+WEl^QL}ftp7YG~Im`;t8CEI^({M+B=LqGO(}-](xv');
define('NONCE_SALT',       '4#{47w]Q<#tWTpdI:*eqGb;jEfqRWmy9_=LclA:R:2c^?lFP,Lah>qh,>VVyChz_');

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
