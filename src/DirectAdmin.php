<?php

namespace Solitweb\LaravelDirectAdmin;

use Solitweb\DirectAdmin\DirectAdmin;

class LaravelDirectAdmin
{
    protected $connection;

    public function __construct(DirectAdmin $connection)
    {
        $this->connection = $connection;
    }

    public function request($method, $command, $options = [])
    {
        $this->connection->set_method($method);
        $this->connection->query('/CMD_API_'.$command, $options);
        return $this->connection->fetch_parsed_body();
    }
}