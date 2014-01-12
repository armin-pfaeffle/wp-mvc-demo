<?php

namespace MvcDemo\core;


// TODO: Until now, only editor and administrator can use this plugin.
class Capability
{
	private $roles = ['editor', 'administrator'];


	public function register()
	{
		foreach ($this->roles as $roleName) {
			$role = get_role($roleName);
		    if (!$role->has_cap(MVC_DEMO_CAPABILITY)) {
    			$role->add_cap(MVC_DEMO_CAPABILITY);
		    }
		}
	}

	public function unregister()
	{
		foreach ($this->roles as $roleName) {
			$role = get_role($roleName);
		    if ($role->has_cap(MVC_DEMO_CAPABILITY)) {
    			$role->remove_cap(MVC_DEMO_CAPABILITY);
		    }
		}
	}
}