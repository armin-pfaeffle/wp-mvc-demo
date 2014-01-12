<?php

namespace MvcDemo\core;


class Menu
{
	public function build($items, $functionCallback, $icon = '')
	{
		if (empty($items) || !is_array($items) || (count($items) != 1)) {
			exit("Items parameter has to be an array with one root element.");
		}

		$rootItem = $items[0];
		$slug = MVC_DEMO_PATH_PREFIX . "/" . $rootItem[3];
		add_menu_page($rootItem[0], $rootItem[1], $rootItem[2], $slug, $functionCallback, $icon);

		if (array_key_exists("items", $rootItem) && is_array($rootItem["items"]) && (count($rootItem["items"]) > 0)) {
			$this->printSubpages($rootItem["items"], $slug, $functionCallback);
		}
	}

	protected function printSubpages($items, $parentSlug, $functionCallback)
	{
		foreach ($items as $item) {
		$slug = MVC_DEMO_PATH_PREFIX . "/" . $item[3];
			add_submenu_page($parentSlug, $item[0], $item[1], $item[2], $slug, $functionCallback);
			if (array_key_exists("items", $item) && is_array($item["items"]) && (count($item["items"]) > 0)) {
				$this->printSubpage($item, $slug);
			}
		}
	}
}


