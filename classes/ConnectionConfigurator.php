<?php namespace Keios\Telekinesis\Classes;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Facades\File;
use Keios\Telekinesis\Models\Server;

class ConnectionConfigurator
{
    protected $config;

    protected $cache;

    public function __construct(Config $repository)
    {
        $this->config = $repository;
        $this->config->set('remote.default', '');
    }

    public function configureAll()
    {
        foreach (Server::all() as $server) {
            $this->configure($server);
        }
    }

    public function configure(Server $server)
    {
        $serverDetails = [
            'host' => $server->ip.':'.$server->port,
            'username' => $server->username,
            'password' => $server->password,
            'key' => $server->key_path,
            'keyphrase' => $server->key_phrase,
            'root' => $server->root
        ];

        if (!is_array($this->config->get('remote.connections'))) {
            $this->config->set('remote.connections', []);
        }

        $this->config->set('remote.connections'.'.'.$server->getServerLabel(), $serverDetails);
    }
}