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
     * Add a route
     *
     * @param string $route
     * @param $params
     *
     * @return void
     */
    public function add(string $route, $params): void
    {
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
        foreach($this->routes as $route => $params){
            if($url == $route){
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