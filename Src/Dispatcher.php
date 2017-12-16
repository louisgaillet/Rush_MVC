<?php
require_once('router/router.php');
require_once('../Controllers/AppController.php');

	class Dispatcher extends AppController 
	{

		public function __construct(){
			$this->redirect($_GET['url']);
		}

	} 
	
?>