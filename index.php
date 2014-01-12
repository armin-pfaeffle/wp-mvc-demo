<?php

/*
Plugin Name: MvcDemo
Plugin URI: http://www.armin-pfaeffle.de/
Description: Demo how you can start a plugin with MVC pattern instead of procedural way.
Version: 0.1
Author: Armin Pfäffle
Author URI: http://www.armin-pfaeffle.de/
License: MIT license (http://www.armin-pfaeffle.de/licenses/mit)
*/


// Load global constants
require_once('constants.php');

// Before any logic, we should check required versions, so everything works fine
if (version_compare(phpversion(), MVC_DEMO_REQUIRED_PHP_VERSION, "<")) {
    exit(sprintf("Plugin requires PHP %s or newer.", MVC_DEMO_REQUIRED_PHP_VERSION));
}
if (version_compare(get_bloginfo('version'), MVC_DEMO_REQUIRED_WP_VERSION, "<")) {
	exit(sprintf("Plugin requires WordPress %s or newer.", MVC_DEMO_REQUIRED_WP_VERSION));
}

// ... aaaaaaannnnnd go!
require_once(dirname(__FILE__) . '/core/Bootstrap.php');
$config = require(dirname(__FILE__) . '/config.php');
$bootstrap = new \MvcDemo\Core\Bootstrap($config);
