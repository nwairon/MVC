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

    /**
     * Render a view template using Twig
     *
     * @param string $template
     * @param array $args
     *
     * @return void
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public static function renderTemplate(string $template, array $args = []): void
    {
        static $twig = null;

        if($twig === null){
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__).'/App/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}