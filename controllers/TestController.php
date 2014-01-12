<?php

namespace MvcDemo\controllers;


class TestController extends \MvcDemo\core\Controller
{
	public function actionIndex()
	{
		// Here we use the viewFile "main" stored under views/test
		// test is the controller Id -> TestController
		// Furthermore we define a variable that is usable as $version
		// in the view file.
		$this->render('main', array(
			'version' => MVC_DEMO_VERSION
		));
	}

	public function actionFoo()
	{
		// Here we print directly the output, without using any view file
		echo 'Fooooooooooooooooooooooooooooooooooooooooooooooo....';
	}
}
