<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;

class Home extends \Core\Controller
{

    /**
     * Before filter
     *
     * @return bool
     */
    protected function before(): bool
    {
        echo "(before) ";
//        return false;
        return true;
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after(): void
    {
        echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(): void
    {
//        View::render('Home/index.php', [
//            'name'      =>  'Dave',
//            'colors'    =>  ['red', 'green', 'blue']
//        ]);
        View::renderTemplate('Home/index.html', [
            'name'      =>  'Dave',
            'colors'    =>  ['red', 'green', 'blue']
        ]);
    }
}