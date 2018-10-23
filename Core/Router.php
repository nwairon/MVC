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
        
        // Convert variables with custom regular expressions e.g. {id:\d+}
	    $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

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
	 *
	 *
	 * @param string $url
	 *
	 * @return string
	 */
    public function dispatch(string $url): void
    {
    	if($this->match($url)){
    		$controller = $this->params['controller'];
    		$controller = $this->convertToStudlyCaps($controller);
    		
    		if(class_exists($controller)){
    			$controller_object = new $controller();
    			
    			$action = $this->params['action'];
    			$action = $this->convertToCamelCase($action);
    			
    			if(is_callable([$controller_object, $action])){
    				$controller_object->$action();
			    }else{
    				echo "Method $action (in controller $controller) not found";
			    }
		    }else{
    			echo "Controller class $controller not found";
		    }
	    }else{
    		echo 'No route matched.';
	    }
    }
	
	/**
	 * Convert the string with hyphens to Studly Caps,
	 * e.g. post-authors => PostAuthors
	 *
	 * @param string $string
	 *
	 * @return string
	 */
    protected function convertToStudlyCaps(string $string): string
    {
    	return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
	
	/**
	 * Convert the string with hyphens to camelCase,
	 * e.g. add-new => addNew
	 *
	 * @param string $string
	 *
	 * @return string
	 */
    protected function convertToCamelCase(string $string): string
    {
    	return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}