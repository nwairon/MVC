<?php
declare(strict_types=1);

namespace App\Controllers;

/**
 * Posts controller
 */

class Posts extends \Core\Controller
{
	
	/**
	 * Show the index page
	 *
	 * @return void
	 */
	public function indexAction(): void
	{
		echo 'Hello from the index action in the Posts controller!';
		echo '<p>Query string parameters: <pre>' .
            htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
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