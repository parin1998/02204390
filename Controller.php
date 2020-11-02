class Controller
{
	function __construct()
	{
		// $this->view = new View();
	}
	public function loadModel($name)
	{
		$path = 'app/models/' . $name . '_model.php';
		if (file_exists($path)) {
			require 'app/models/' . $name . '_model.php';
			$modelName = $name . '_model';
			$this->model = new $modelName();
		}
	}
}