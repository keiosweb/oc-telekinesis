<?php namespace Keios\Telekinesis;

use System\Classes\PluginBase;
use Backend;

/**
 * Telekinesis Plugin Information File
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
            'name' => 'keios.telekinesis::lang.plugin.pluginName',
            'description' => 'keios.telekinesis::lang.plugin.pluginDescription',
            'author' => 'Keios',
            'icon' => 'icon-leaf'
        ];
    }

    public function registerNavigation()
    {
        return [
            'telekinesis' => [
                'label' => 'keios.telekinesis::lang.plugin.pluginName',
                'url' => Backend::url('keios/telekinesis/dashboard'),
                'icon' => 'icon-cogs',
                'permissions' => ['keios.telekinesis.*'],
                'order' => 500,
                'sideMenu' => [
                    'dashboard' => [
                        'label' => 'keios.telekinesis::lang.plugin.dashboard',
                        'icon' => 'icon-th',
                        'url' => Backend::url('keios/telekinesis/dashboard'),
                        'permissions' => ['keios.telekinesis.access_dashboard'],
                    ],
                    'servers' => [
                        'label' => 'keios.telekinesis::lang.plugin.servers',
                        'icon' => 'icon-server',
                        'url' => Backend::url('keios/telekinesis/servers'),
                        'permissions' => ['keios.telekinesis.access_servers'],
                    ],
                    'tasks' => [
                        'label' => 'keios.telekinesis::lang.plugin.tasks',
                        'icon' => 'icon-tasks',
                        'url' => Backend::url('keios/telekinesis/tasks'),
                        'permissions' => ['keios.telekinesis.access_tasks']
                    ],
                    'outputs' => [
                        'label' => 'keios.telekinesis::lang.plugin.outputs',
                        'icon' => 'icon-copy',
                        'url' => Backend::url('keios/telekinesis/outputs'),
                        'permissions' => ['keios.telekinesis.access_outputs']
                    ],
                ]

            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'keios.telekinesis.access_dashboard' => ['label' => 'keios.telekinesis::lang.permissions.dashboard'],
            'keios.telekinesis.access_servers' => ['label' => 'keios.telekinesis::lang.permissions.servers'],
            'keios.telekinesis.access_tasks' => ['label' => 'keios.telekinesis::lang.permissions.tasks'],
            'keios.telekinesis.access_outputs' => ['label' => 'keios.telekinesis::lang.permissions.outputs'],
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Keios\Telekinesis\FormWidges\CommandsWidget' => 'taskCommands'
        ];
    }

    public function register()
    {
        $this->app->register('Keios\Telekinesis\Classes\TelekinesisServiceProvider');
    }

    public function boot()
    {
        /**
         * @var \Keios\Telekinesis\Classes\ConnectionConfigurator $connections
         */
        $connections = $this->app->make('telekinesis.connections');
        $connections->configureAll();
    }

}
