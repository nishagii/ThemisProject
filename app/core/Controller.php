<?php 


Trait Controller
{
	public function requireLogin()
	{
		if (!isset($_SESSION['role'])) {
			redirect('/login');
			exit();
		}
	}

	protected function requireRole($roles = [])
	{
		if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $roles)) {
			redirect('_403');
			exit();
		}

	}


	public function view($name, $data = [])
	{

		if (!empty($data))
			extract($data);

		$filename = "../app/views/" . $name . ".view.php";
		if (file_exists($filename)) {
			require $filename;
		} else {
			$filename = "../app/views/404.view.php";
			require $filename;
		}
	}

	public function loadModel($model)
	{
		$modelPath = "../app/models/" . $model . ".php";

		if (file_exists($modelPath)) {
			require_once $modelPath;

			// Return an instance of the model class
			return new $model();
		} else {
			die("The model file {$modelPath} does not exist.");
		}
	}

}