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

    /**
     * Set method to GET.
     *
     * @return $this
     */
    public function get() {
        $this->connection->set_method('GET');
        return $this;
    }

    /**
     * Set method to POST.
     *
     * @return $this
     */
    public function post() {
        $this->connection->set_method('POST');
        return $this;
    }

    /**
     * Do an API request.
     *
     * @return array result parsed
     */
    public function request($method, $command, $options = [])
    {
        $this->connection->query('/CMD_API_'.$command, $options);
        return $this->connection->fetch_parsed_body();
    }
}