<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;
use App\Models\Post;

/**
 * Posts controller
 */

class Posts extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
	public function indexAction(): void
	{
        $posts = Post::getAll();

        View::renderTemplate('Posts/index.html.twig', [
            'posts' => $posts
        ]);
	}
	
	/**
	 * Show the add new page
	 *
	 * @return void
	 */
	public function addNewAction(): void
	{
		echo 'Hello from the addNew action in the Posts controller!';
	}

	public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<>Route parameters: <pre>' .
            htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}