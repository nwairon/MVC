<?php
declare(strict_types=1);

namespace Core;

abstract class Controller
{

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Controller constructor.
     * @param array $route_params
     */
    public function __construct(array $route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * @param $name
     * @param $args
     * @throws \Exception
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if(method_exists($this, $method)){
            if($this->before() !== false){
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
//            echo "Method $method not found in controller " . get_class($this);
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     *
     * @return bool
     */
    protected function before(): bool
    {
        return true;
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after(): void
    {

    }
}