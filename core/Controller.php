<?php

namespace MvcDemo\core;

use MvcDemo\components\helper\StringHelper;


class Controller
{
	protected function getId()
	{
		$fullQualifiedClassName = get_class($this);

		// Remove namespace
		if (strpos($fullQualifiedClassName, '\\') !== false) {
			$className = substr($fullQualifiedClassName, strrpos($fullQualifiedClassName, '\\') + 1);
		}

		// Remove "Controller" string at the end
		if (StringHelper::endsWith($className, 'Controller', false)) {
			$id = substr($className, 0, strlen($className) - strlen('Controller'));
		}

		$id = lcfirst($id);
		return $id;
	}

	public function render($viewFile, $data = array(), $return = false)
	{
		$filename = $this->getViewFilename($viewFile);

		// Prepare parameters
		if (is_array($data) && count($data) > 0) {
			extract($data, EXTR_PREFIX_SAME, 'data');
		}

		if ($return) {
			ob_start();
		}
		include($filename);
		if ($return) {
			return ob_get_clean();
		}
	}

	protected function getViewFilename($viewFile)
	{
		// If $viewFile contains a slash it should be ensured that a correct
		// path separator is used, so views can be placed in subdirectories
		$viewFile = str_replace('\\', DIRECTORY_SEPARATOR, $viewFile);

		// Obtain complete filename of view, placed under views/<controller_id>/
		$controllerId = $this->getId();
		$filename = MVC_DEMO_PLUGIN_DIR . 'views' . DIRECTORY_SEPARATOR . $controllerId . DIRECTORY_SEPARATOR . $viewFile . '.php';

		return $filename;
	}
}