<?php

define('DB_NAME', 'itm');
define('DB_USER', 'root');
define('DB_PASSWORD', 'mysql');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_general_ci;');

define('AUTH_KEY',         'telemedellinnoticias');
define('SECURE_AUTH_KEY',  'Pab10P4li110206/(/((*^^');
define('LOGGED_IN_KEY',    'Pab10P4li110206/(/((*^^');
define('NONCE_KEY',        'pPab10P4li110Noticias');
define('AUTH_SALT',        'Pab10P4li110HAHA');
define('SECURE_AUTH_SALT', 'Pab10P4li110SHA1ZUMBALE');
define('LOGGED_IN_SALT',   'ZUBAZUBAEEPab10P4li110SHA1');
define('NONCE_SALT',       'Pab10P4li110206/(/((*^^');

$table_prefix  = 'itm_';

define('WP_DEBUG', false);

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');

