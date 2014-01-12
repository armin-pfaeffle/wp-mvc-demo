MvcDemo                         :
=======

This small project is a demo how you can use the MVC pattern in Wordpress
plugins. It creates a menu in the administration view, but it should be
easy to transform to satisfy your needs. The reason why I created this is
that I have not found any good tutorial nor a complete example like this.

It's minified to the main parts, so you can start adding your code. Some
code is annotated where I thought it's useful for you.

Please let me know if there are any errors or improvements you would add to
the code.

Armin Pfäffle
mail@armin-pfaeffle.de


Requirements
------------

At the moment this plugin demo is for current Wordpress version 3.8. I do
not know if it works with other version too, because it have not checked
that. Try it on your own ;)

Further more your server has to support PHP 5.3 or aboce because of using
the namespace feature. You can remove the namespaces, so the code is usable
with earlier versions of PHP, but please check all the code then!


How the plugin works
--------------------

The entry point is always `index.php` which does some checks and creates
an instance of Bootstrap class for the main job. The Bootstrap
instance registers an autoload method, so unknown classes are loaded
automatically and it registers some important hooks:

* plugin activation
* plugin deactivation
* building admin menu
* initialization of plugin

With the activation/deactivation of the plugin a capability is registered/
unregisteredm given bye the constant `MVC_DEMO_CAPABILITY`. So it's possible
to control rights.

The menu is configured by the parameters set in `config.php`. So it's a kind
of widget for simple administration menu generation.

The important method is the `runController()` in Bootstrap class. This
method parses the `page`, loads the controller given by `page` and calls the
corresponding method. Here an example:

```
Page: mvc-demo/**test**/**foo**
-> Controller: **Test**Controller
-> Method: action**Foo**
```

Some hints:

* to ensure that a page is mapped to our plugin and does not conflict with
  another plugin, it's prefixed with `MVC_DEMO_PATH_PREFIX`
* controller classes are suffixed by `Controller`
* methods are prefixed with `action`

So... I hope the rest is clear?! When not, please let me know!
