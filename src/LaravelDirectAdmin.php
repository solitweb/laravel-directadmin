<?php

namespace Solitweb\LaravelDirectAdmin;

use Solitweb\DirectAdmin\DirectAdmin;

class LaravelDirectAdmin
{
    protected $connection;

    protected $command;

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
    public function request($command, $options = [])
    {
        $this->connection->query('/CMD_API_'.$command, $options);
        return $this->connection->fetch_parsed_body();
    }

    /**
     * Do an API request.
     *
     * @return array result parsed
     */
    public function requestjson($command, $options = [])
    {
        $json = ['json' => 'yes'];
        $options = array_merge($json, $options);
        $this->connection->query('/CMD_API_'.$command, $options);
        return json_decode($this->connection->fetch_body());
    }
    
    /**
     * Return the last HTTP status code.
	 * 200 = OK;
	 * 403 = FORBIDDEN;
	 * etc.
     *
     * @return int HTTP status code
     */
    public function get_status_code()
    {
        return $this->connection->get_status_code();
    }
    
    /**
	 * Specify a username and password.
	 *
	 * @param string|null username. default is null
	 * @param string|null password. default is null
	 */
    public function set_login($username, $password)
    {
        $this->connection->set_login($username, $password);
    }

    /**
     * Magic Method
     *
     * @param $methodName
     * @param $arguments
     * @return bool
     * @throws \Exception
     */
    public function __call($methodName, $arguments)
    {
        $arguments = count($arguments) > 0 ? $arguments[0] : $arguments ;

        if(!$response = $this->extractMethod($methodName, $arguments)) {
            throw new \Exception("Invalid method called");
        }

        return $response;
    }

    /**
     * Extract command name from magic method
     *
     * @param $methodName
     * @param $arguments
     * @return bool
     */
    private function extractMethod($methodName, $arguments)
    {
        if(strpos($methodName, "getjson") !== false) {
            return $this->extractCommand("getjson", substr($methodName, 7), $arguments);
        }

        if(strpos($methodName, "get") !== false) {
            return $this->extractCommand("get", substr($methodName, 3), $arguments);
        }

        if(strpos($methodName, "postjson") !== false) {
            return $this->extractCommand("postjson", substr($methodName, 8), $arguments);
        }

        if(strpos($methodName, "post") !== false) {
            return $this->extractCommand("post", substr($methodName, 4), $arguments);
        }

        return false;
    }

    /**
     * Set the command based on the magic method name
     *
     * @param $method
     * @param $command
     * @param $arguments
     * @return array
     */
    private function extractCommand($method, $command, $arguments)
    {
        if($method == "post" || $method == "postjson")
        {
            $this->connection->set_method("POST");
        }
        else
        {
            $this->connection->set_method("GET");
        }


        if($method == "postjson" || $method == "getjson")
        {
            return $this->requestjson(
                $this->camelToSnake($command),
                $arguments
            );
        }
        return $this->request(
            $this->camelToSnake($command),
            $arguments
        );
    }

    /**
     * Convert CamelCase to snake_case
     *
     * @param $string
     * @return string
     */
    private function camelToSnake($string)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return strtoupper(implode('_', $ret));
    }

}
