<?php namespace Keios\Telekinesis\Classes;

use Keios\Telekinesis\Models\Server;
use Illuminate\Support\Collection;
use SSH;

class ServerConfigurator
{
    protected $server;

    public function __construct($serverId)
    {
        if ($serverId === '*') {
            $this->server = Server::with('tasks')->all();
        } else {
            $this->server = Server::with('tasks')->find($serverId);
        }

        if ($this->server instanceof Collection) {
            foreach ($this->server as $server) {
                $this->setUpTasksFor($server);
            }
        } elseif ($this->server instanceof Server) {
            $this->setUpTasksFor($this->server);
        }
    }

    public function setUpTasksFor(Server $server)
    {
        /**
         * @var \Illuminate\Support\Collection $tasks
         */
        $tasks = $server->tasks;

        /**
         * @var \Keios\Telekinesis\Models\Task $task
         */
        foreach ($tasks as $task) {
            SSH::into($server->getServerLabel())->define(
                $task->getTaskLabel(),
                $task->getTaskCommands()
            );
        }
    }

    /**
     * @return \Keios\Telekinesis\Models\Server|\Illuminate\Support\Collection|null
     */
    public function getServer()
    {
        return $this->server;
    }
}