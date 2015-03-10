<?php namespace Keios\Telekinesis\Classes;

use Keios\Telekinesis\Models\Output;
use Keios\Telekinesis\Models\Server;
use Illuminate\Support\Collection;
use SSH;

class TaskRunner
{
    protected $serverConfigurator;

    protected $servers;

    protected $outputs = [];

    protected $taskIds;

    protected $completedTasksCount = 0;

    public function __construct(array $servers, array $tasks)
    {
        $this->taskIds = $tasks;
        $this->configureServers($servers);
    }

    public function runTasks()
    {
        if ($this->servers instanceof Collection) {

            foreach ($this->servers as $server) {
                foreach ($this->taskIds as $taskId) {
                    $this->runTask($server, $taskId);
                }
            }

        } elseif ($this->servers instanceof Server) {

            foreach ($this->taskIds as $taskId) {
                $this->runTask($this->servers, $taskId);
            }
        }
    }

    protected function runTask(Server $server, $taskId)
    {
        /**
         * @var \Illuminate\Support\Collection $serverTasks
         */
        $serverTasks = $server->tasks;

        /**
         * @var \Keios\Telekinesis\Models\Task $task
         */
        foreach ($serverTasks as $task) {

            /*
             * Check if this server has requested task
             */
            if ($task->id == $taskId) {

                /*
                 * Prepare output model and bind it to current server and task
                 */
                $output = new Output();
                $output->server = $server;
                $output->task = $task;

                $lines = [];

                SSH::into($server->getServerLabel())->run(
                    $task->getTaskCommands(),
                    function ($line) use (&$lines) {
                        $lines[] = $line;
                    }
                );

                $output->output = $lines;

                $output->save();

                $this->outputs[] = $output;

                $this->completedTasksCount++;
            }
        }
    }

    protected function configureServers(array $servers)
    {
        $this->serverConfigurator = new ServerConfigurator($servers);

        $this->servers = $this->serverConfigurator->getServer();
    }

    public function getOutputs()
    {
        return $this->outputs;
    }

    public function getCompletedTasksCount()
    {
        return $this->completedTasksCount;
    }
}