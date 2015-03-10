<?php namespace Keios\Telekinesis\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Keios\Telekinesis\Classes\ServerConfigurator;
use Keios\Telekinesis\Classes\TaskRunner;
use Keios\Telekinesis\Models\Server;
use SSH;

/**
 * Dashboard Back-end Controller
 */
class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Keios.Telekinesis', 'telekinesis', 'dashboard');
    }

    public function index()
    {
        /**
         * @var \Keios\Telekinesis\Models\Server $mf
         */
        $mf = Server::find(1);

        $config = new ServerConfigurator($mf->id);

        $results = [];
        /*
        try {
            SSH::into($mf->getServerLabel())->run(
                ['cd /srv/www/workbench/october', 'php artisan'],
                function ($line) use (&$results) {
                    $results[] = $line;
                }
            );
        } catch (\Exception $ex) {
            $results[] = $ex->getMessage();
        }
        */

        try {
            $taskRunner = new TaskRunner([1], [3]);
            $taskRunner->runTasks();
            $outputs = $taskRunner->getOutputs();
            foreach ($outputs as $output) {
                foreach ($output->output as $line) {
                    $results[] = $line;
                }
            }
        } catch (\Exception $ex) {
            $results[] = $ex->getMessage();
        }

        $this->vars['results'] = $results;
    }
}