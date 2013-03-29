<?php 

require ("model.php");
require ("router.php");

class Controller {

	private $model;
	private $router;

	// Constructor
	function _construct() {
		// private variables
		$this->model = new Model();
		$this->router = new Router();

			// Process query string
			$queryParams = false;
			if (strlen($_GET['query']) > 0)
			{
				$queryParams = explode("/", $_GET['query']);
			}

			$page = $_GET['page'];
		// Handle Page Load
		$endpoint = $this->router->lookup($page);
		if ($endpoint === false)
		{
			header("HTTP/1.0 404 NOT FOUND");
		}
		else
		{
			$this->$endpoint($queryParams);
		}
	}

	private function redirect($url) {
		header ("Location: /" .$url);
	}

	private function loadView($view, $data = null) {
		if (is_array($data))
		{
			extract($data);
		}

		require ("Views/" .$view. ".php");
	}

	private function loadPage($user, $view, $data = null, $flash = false) {

		$this->loadView("header", array('User' => $user));
		if ($flash !== false)
		{
			$flash->display();
		}

		$this->loadView($view, $data);
		$this->loadView("footer");
	}

	private function checkAutho() {
		if (isset($_COOKIE['Auth']))
		{
			return $this->model->userForAuth($_COOKIE['Auth']);
		}
		else
		{
			return false;
		}
	}
}