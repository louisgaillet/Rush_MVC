<?php 

include_once('../Models/Users/User.php');
include_once('../Models/Articles/Article.php');
include_once '../Models/Form.php';
include_once '../Src/Session.php';


	class WritterController extends AppController{

		protected $id;

		public function __construct()
		{
			parent::__construct();
			$this->article = $this->model('Article');
			$this->viewPath = ROOT . 'Views/';
			//session_start();
		}

		public function getPosts()
		{
			$authorId= Session::read('Auth','Id');
			$data = $this->article->getPostByAuthor($authorId);
			$this->render('Users/getAllPost', compact('data') );
		}

		
	}
 ?>