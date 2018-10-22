<?php
declare(strict_types=1);

class Router
{
    /**
     * Routing Table
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters
     * @var array
     */
    protected $params = [];

    /**
     * Adds a route
     *
     * @param string $route
     * @param array $params
     *
     * @return void
     */
    public function add(string $route, $params = []): void
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * Get all routes
     *
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Match the route to the table
     *
     * @param string $url
     * @return bool
     */
    public function match(string $url): bool
    {
        // Match to the fixed URL format /controller/action
        //$reg_exp = "/^(?<controller>[a-z-]+)\/(?<action>[a-z-]+)$/";

        foreach ($this->routes as $route => $params){
            if(preg_match($route, $url, $matches)){
                // Get named capture group values
                //$params = [];

                foreach ($matches as $key => $match){
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}