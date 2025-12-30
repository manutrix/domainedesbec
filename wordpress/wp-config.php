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
define('DB_NAME', getenv('WORDPRESS_DB_NAME') ?: 'dev_domainedesbec');

/** MySQL database username */
define('DB_USER', getenv('WORDPRESS_DB_USER') ?: 'root');

/** MySQL database password */
define('DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') ?: '');

/** MySQL hostname */
define('DB_HOST', getenv('WORDPRESS_DB_HOST') ?: 'mysql');

// In a Docker/dev setup, the database often contains the original domain.
// For a “docker compose up -d and it works” experience, force HOME/SITEURL.
$__wp_scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$__wp_host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';
$__wp_default_url = $__wp_scheme . '://' . $__wp_host;
define('WP_HOME', getenv('WORDPRESS_HOME') ?: $__wp_default_url);
define('WP_SITEURL', getenv('WORDPRESS_SITEURL') ?: (getenv('WORDPRESS_HOME') ?: $__wp_default_url));

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
define('AUTH_KEY',         'g^lMCUk?0?&c?/gZi6+f:?Y`<nqcYMG{5V.MlZb3n:>xMpp]T/OGt?Z(t7*(Qadl');
define('SECURE_AUTH_KEY',  '51k?W-k:AR/Lg*O9sx,E-(9g`Hn^/KeO4J&pUUK(!;DC^DDwSxyz;DBd[^E_B/%)');
define('LOGGED_IN_KEY',    'rD]4C7J<P6%HAl8(BvPw=^i?l&QF$>HM$oySrW-$$$<R&I!rmOpDYY)8)#>r>3e@');
define('NONCE_KEY',        'z^@q6qRIUx4gj,(aTK spqz_S]umN(5BEP8`BReN?}P=,|1s2X=)&zR%;XX_jM>P');
define('AUTH_SALT',        '&{K:K#.|.fsz3Gc+OMaV#cNm*lK5 ~3]jUI_j@3u1zC(3J$k4E/Ez@Ix!LUr2(v*');
define('SECURE_AUTH_SALT', '3R0Lp.#lJ53z4#k~&%o!XN$a ~)O)1CU_e/ c5ux8|jH)|R&.Z$Rs9wU:2)esp@)');
define('LOGGED_IN_SALT',   'JD>A5}TZq=UWWQV1Zlf/lx~i4Qcnkbb `fGW2(7c;dg^{y|?<<v<tlID&hrK}x(5');
define('NONCE_SALT',       '98X$J)eL>$pN^wO3I):]m9db}p1hGW^CGf(HYygisTL}kEe0[aEBbO+rfF0Z/gw)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dmnbec_';

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
define('WP_DEBUG', getenv('WORDPRESS_DEBUG') === '1');

if ( defined('WP_DEBUG') && WP_DEBUG ) {
	define('WP_DEBUG_LOG', true);
	define('WP_DEBUG_DISPLAY', false);
	@ini_set('display_errors', '0');
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
