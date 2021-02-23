<?php namespace Codecycler\Toolbox;

use Event;
use Backend;
use System\Classes\PluginBase;
use Codecycler\Toolbox\Classes\Extend\ActionManager;
use Codecycler\Toolbox\Classes\Event\ExtendThemeData;
use Codecycler\Toolbox\FormWidgets\PropertyInspector;
use Codecycler\Toolbox\Classes\Extend\ActionPathHelper;

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
            'author'      => 'Codecycler',
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

        ActionPathHelper::instance()
            ->register();
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
            $controller->addJs('/plugins/codecycler/toolbox/assets/js/jjsonviewer.js');
            $controller->addJs('/plugins/codecycler/toolbox/assets/js/oc.json-format.js');
            $controller->addCss('/plugins/codecycler/toolbox/assets/css/jjsonviewer.css');

            $controller->addCss('/plugins/codecycler/toolbox/assets/css/backend.css');
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Codecycler\Toolbox\Components\FrontendForm' => 'frontendForm',
            'Codecycler\Toolbox\Components\AjaxPanel' => 'ajaxPanel',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'codecycler.toolbox.manage_tags' => [
                'tab' => 'Toolbox',
                'label' => 'Manage tags'
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
                'url'         => Backend::url('codecycler/toolbox/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['codecycler.toolbox.*'],
                'order'       => 500,
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'tags' => [
                'label'       => 'Tags',
                'description' => 'Manage tags',
                'category'    => 'Toolbox',
                'icon'        => 'icon-tag',
                'url'         => Backend::url('codecycler/toolbox/tags'),
                'order'       => 500,
                'keywords'    => 'tags toolbox',
                'permissions' => ['codecycler.toolbox.manage_tags'],
            ]
        ];
    }

    public function registerFormWidgets()
    {
        return [
            PropertyInspector::class => 'propertyinspector',
        ];
    }
}
