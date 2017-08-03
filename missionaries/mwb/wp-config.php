<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'calvary_mwb');

/** MySQL database username */
define('DB_USER', 'calvary_mwb');

/** MySQL database password */
define('DB_PASSWORD', 'MiWiBo123!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'H7;`[*AUcbTVES[;9`]9G<(<kSnQ{f+eOW=g&muxrAR<zo:%UD8;Tt@g<L:TLZ=Z');
define('SECURE_AUTH_KEY',  'qoz|{$]+C{UP]n&(:;<Xn=:Ra--4nwUu<^0I`7!r47WuG9Ol3Z+OPUcb{.ybj^/t');
define('LOGGED_IN_KEY',    'k/y5^Slo%U^2cJtJb9WNC9k)1l#SQ2#t4jl>7DvIh{])`WoV ar=8)E06)CjE`gy');
define('NONCE_KEY',        '1 VBZdfB?Ci0Rkc@<NV;}5e0Oj3EIIA78.8+}M>9zq]cji+k`G@*6ck0+$@&-k5P');
define('AUTH_SALT',        ',#}6VweWR>$C+zvY1J2A-y4}rX{1m$dUNM||h8nWTL`5SyU46]kE?Et,D<*;S=Z_');
define('SECURE_AUTH_SALT', '_L-h+x]&6TNlAqiZCNt jC!>E3u>WrSBi8J-Q!b>ac hFQ<$d[gg$2 Wf4h)@g~r');
define('LOGGED_IN_SALT',   'w$-LqUX|U`=3?`BaP{&U{8v)![Rzo+OG{:U#5QKu1Ei<`oLPWI6li]I<@V@`VOzz');
define('NONCE_SALT',       'z:R=:-bcPK@JI#{2x+($.4JmF.=fVFbO:;c:b ar=qHR|7TPr%4|,=?R!jK-|AeN');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpm_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
