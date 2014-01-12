<?php

return [
	"defaultController" => "Test",
	"defaultControllerAction" => "Index",

	"menu" => [
		// Icon documentation: http://codex.wordpress.org/Function_Reference/add_menu_page
		// Dashicons:  http://melchoyce.github.io/dashicons/
		"icon" => "dashicons-smiley",
		"items" => [
			["MvcDemo", "MvcDemo", MVC_DEMO_CAPABILITY, "test", "items" => [
				["Page Title Foo", "Foo", MVC_DEMO_CAPABILITY, "test/foo"],
				["Page Title Bar", "Bar", MVC_DEMO_CAPABILITY, "other/bar"], // here it's an other controller
			]],
		],
	],
];
