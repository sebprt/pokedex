<?php

class Request
{
    private array $query;
    private array $request;

    public function __construct()
    {
        $this->query = $_GET;
        $this->request = $_POST;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function get(string $param, $default = null)
    {
        if ($this->query) {
            $value = \array_key_exists($param, $this->query) ? $this->query[$param] : $default;
        } else {
            $value = \array_key_exists($param, $this->request) ? $this->request[$param] : $default;
        }

        return $value;
    }

    public function all()
    {
        return array_merge($this->query, $this->request);
    }
}
