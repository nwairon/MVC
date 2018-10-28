<?php
declare(strict_types=1);

namespace Core;

class View
{

    /**
     * Render a view file
     *
     * @param string $view
     * @param array $args
     *
     * @return void
     */
    public static function render(string $view, array $args = []): void
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; // relative to Core directory

        if(is_readable($file)){
            require $file;
        }else{
            echo "$file not found";
        }
    }
}