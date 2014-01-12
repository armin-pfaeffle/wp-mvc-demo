<?php

define('MVC_DEMO_VERSION',				'0.1');

define('MVC_DEMO_REQUIRED_PHP_VERSION',	'5.4'); // perhaps we can reduce that later
define('MVC_DEMO_REQUIRED_WP_VERSION',	'3.8'); // perhaps we can reduce that later

define('MVC_DEMO_PLUGIN_DIR',			dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('MVC_DEMO_MAIN_PLUGIN_FILE',		dirname(__FILE__) . DIRECTORY_SEPARATOR . 'index.php');
define('MVC_DEMO_PATH_PREFIX',			'mvc-demo');
define('MVC_DEMO_CAPABILITY',			'mvc_demo_manage');

define('MVC_DEMO_LOG_FILENAME',			MVC_DEMO_PLUGIN_DIR . 'runtime' . DIRECTORY_SEPARATOR . 'log.txt');
