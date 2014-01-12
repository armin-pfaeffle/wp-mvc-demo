<?php

namespace MvcDemo\core;


class Bootstrap
{
	private static $classMap;
	private $config;


	public function __construct($config)
	{
		$this->config = $config;

		$this->registerAutoload();
		$this->registerHooks();
	}

	public static function getVersion()
	{
		return MVC_DEMO_VERSION;
	}

	protected function registerAutoload()
	{
		spl_autoload_register(array($this, 'autoload'));
	}

	protected function registerHooks()
	{
		register_activation_hook(MVC_DEMO_MAIN_PLUGIN_FILE, array($this, 'onActivate'));
		register_deactivation_hook(MVC_DEMO_MAIN_PLUGIN_FILE, array($this, 'onDeactivate'));

		add_action('admin_menu', array($this, 'onBuildMenu'));
		add_action('admin_init', array($this, 'onInitialize'));

		// Here you can place more hooks
	}

	public function runController()
	{
		$controller = $this->config["defaultController"];
		$action = $this->config["defaultControllerAction"];

		$path = $_GET['page'];
		if (!empty($path)) {
			$pluginPrefix = MVC_DEMO_PATH_PREFIX . '/';
			if (strpos($path, $pluginPrefix) === 0) {
				$path = substr($path, strlen($pluginPrefix));
			}
		}
		if (strlen($path) > 0) {
			$path = explode('/', $path);
			if (count($path) > 0) {
				$controller = $path[0];
			}
			if (count($path) > 1) {
				$action = $path[1];
			}
		}


		$controller = "MvcDemo\\controllers\\" . ucfirst($controller) . 'Controller';
		$method = 'action' . ucfirst($action);

		$instance = new $controller();
		if (method_exists($instance, $method)) {
			$args = array();
			call_user_func_array(array($instance, $method), $args);
		}
	}

	public static function autoload($className)
	{
		if (isset(static::$classMap[$className])) {
			$classFile = static::$classMap[$className];
		} else {
			// Split class by namespace separator and map parts to absolute path
			$splittedQualifiedName = explode('\\', $className);
			if ($splittedQualifiedName[0] == 'MvcDemo') {
				array_shift($splittedQualifiedName);
			}
			$classFile = MVC_DEMO_PLUGIN_DIR . implode(DIRECTORY_SEPARATOR, $splittedQualifiedName) . '.php';
            if (!is_file($classFile)) {
				return;
            }
		}
		include($classFile);
	}

	public function onActivate()
	{
		Log::write('onActivate', Log::DEBUG);

		$capability = new Capability();
		$capability->register();
	}

	public function onDeactivate()
	{
		Log::write('onDeactivate', Log::DEBUG);

		$capability = new Capability();
		$capability->unregister();
	}

	public function onBuildMenu()
	{
		Log::write('onBuildMenu', Log::DEBUG);

		$items = $this->config['menu']['items'];
		$functionCallback = array($this, "runController");
		$icon = $this->config['menu']['icon'];

		$menu = new Menu();
		$menu->build($items, $functionCallback, $icon);
	}

	public function onInitialize()
	{
		Log::write('onInitialize', Log::DEBUG);

	}
}
