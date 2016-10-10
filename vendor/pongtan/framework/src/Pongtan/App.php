<?php

namespace Pongtan;

use Pongtan\Services\Config;
use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

class App
{
    protected $basePath;

    public function __construct()
    {
    }

    /**
     * @param $path
     */
    public function setBasePath($path)
    {
        $this->basePath = $path;
    }

    public function loadEnv()
    {
        $env = new Dotenv($this->basePath);
        $env->load();
    }

    public function setDebug()
    {
        // debug
        if (Config::get('debug') == "true") {
            define("DEBUG", true);
        }
    }

    public function setVersion($version)
    {
        $_ENV['version'] = $version;
    }

    public function setTimezone()
    {
        // config time zone
        date_default_timezone_set(Config::get('timeZone'));
    }

    public function bootDb()
    {
        // Init Eloquent ORM Connection
        $capsule = new Capsule;
        $capsule->addConnection(Config::getDbConfig());
        $capsule->bootEloquent();
    }
}