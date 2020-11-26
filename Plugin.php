<?php namespace Kloos\Toolbox;

use Event;
use Backend;
use System\Classes\PluginBase;
use Kloos\Toolbox\Classes\Extend\ActionManager;
use Kloos\Toolbox\Classes\Event\ExtendThemeData;
use Kloos\Toolbox\FormWidgets\PropertyInspector;
use Kloos\Toolbox\Classes\Extend\ActionPathHelper;

/**
 * Toolbox Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Toolbox',
            'description' => 'This toolbox contains all sort of shared functions used by all our products.',
            'author'      => 'Kloos',
            'icon'        => 'icon-rocket'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(ActionManager::class);

        ActionPathHelper::instance()->register();
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Event::subscribe(ExtendThemeData::class);

        Event::listen('backend.page.beforeDisplay', function ($controller) {
            $controller->addJs('/plugins/kloos/toolbox/assets/js/jjsonviewer.js');
            $controller->addJs('/plugins/kloos/toolbox/assets/js/oc.json-format.js');
            $controller->addCss('/plugins/kloos/toolbox/assets/css/jjsonviewer.css');
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Kloos\Toolbox\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'kloos.toolbox.some_permission' => [
                'tab' => 'Toolbox',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'toolbox' => [
                'label'       => 'Toolbox',
                'url'         => Backend::url('kloos/toolbox/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['kloos.toolbox.*'],
                'order'       => 500,
            ],
        ];
    }

    public function registerFormWidgets()
    {
        return [
            PropertyInspector::class => 'propertyinspector',
        ];
    }
}
