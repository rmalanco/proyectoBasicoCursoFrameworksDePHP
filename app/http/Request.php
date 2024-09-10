<?php

namespace App\Http;

class Request
{
    protected $segments = [];
    protected $controller;
    protected $method;

    public function __construct()
    {
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);
        $this->setController();
        $this->setMethod();
    }

    public function getController()
    {
        $controllerClass = ucfirst($this->controller);
        return "App\\Http\\Controllers\\{$controllerClass}Controller";
    }

    public function setController()
    {
        $this->controller = empty($this->segments[1]) ? 'home' : $this->segments[1];
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod()
    {
        $this->method = empty($this->segments[2]) ? 'index' : $this->segments[2];
    }

    public function send()
    {
        $controllerClass = $this->getController();
        $method = $this->getMethod();

        static $controllerInstance = null;
        if ($controllerInstance === null) {
            $controllerInstance = new $controllerClass();
        }

        // Llamar al método directamente
        try {
            $response = $controllerInstance->$method();

            if ($response instanceof Response) {
                $response->send();
            } else {
                throw new \InvalidArgumentException("Error Processing Request");
            }
        } catch (\Exception $e) {
            error_log("Error: {$e->getMessage()}");
            echo "Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.";
        }
    }
}
