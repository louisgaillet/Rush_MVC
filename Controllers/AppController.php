<?php
require_once('../Src/Dispatcher.php');
require_once('ArticlesController.php');
require_once('UsersController.php');
require_once('WritterController.php');
require_once('AdminController.php');
require_once('CommentsController.php');
include_once '../Src/Session.php';
session_start();
//var_dump($_SESSION);

	class AppController
	{
		protected $viewPath;
		protected $model ='Layouts/themeUser.php';
		protected $statusOkay = true;
		protected $urlImg;
		public $message = "";

		public function __construct(){
			if ($this->getGroupe() == 1){
				$this->model='Layouts/themeWritter.php';
			}
			elseif($this->getGroupe() == 2){
				$this->model='Layouts/themeAdmin.php';
			}
		}
		public function model($model){
			return new $model();
		}

		public function render($viewName, $data=[]){
			ob_start();
			extract($data);
			require($this->viewPath.$viewName.'.php');
			$content= ob_get_clean();
			require($this->viewPath.$this->model);

		}


		protected function getGroupe()
		{
			return  intval(Session::read('Auth', 'Groupe'));
		}

		protected function redirect($param){

		
			$router = new Router($param);

			// Tout le monde
			$router->get('/', function(){
				echo "Homepage";
				$controllers = new ArticlesController();
				$controllers->displayPosts();
			});

			$router->get('/blog', function(){
				$controllers = new ArticlesController();
				$controllers->displayPostsForBlog();
			});

			$router->get('/blog/order-by-title', function(){
				$controllers = new ArticlesController();
				$controllers->displayPostbyTile();
			});

			$router->get('/blog/order-by-date', function(){
				$controllers = new ArticlesController();
				$controllers->displayPostbyDate();
			});

			$router->get('/post/:id', function($id){
				$controllers = new ArticlesController();
				$controllers->getPost($id);
			 });

			 $router->post('/post/:id', function($id){
				 $controllers = new CommentsController();
				 $controllers->addComment($id, $_POST);

			 });


			$router->get('/register', function(){
				$controllers = new UsersController();
				$controllers->postRegister('http://localhost/PHP_Rush_MVC/register', 'POST');
			});

			$router->post('/register/', function(){
				$controllers = new UsersController();
				$controllers->register($_POST);
			});

			$router->get('/login', function(){
				$controllers = new UsersController();
				$controllers->postLogin('./login/check', 'POST');
			});

			$router->post('/login/check', function(){
				$controllers = new UsersController();
				$controllers->login($_POST);
			});

			$router->get('/logout/', function(){
				$controllers = new UsersController();
				$controllers->logout($_POST);
			});

			$router->get('/profil', function(){
				$controllers = new UsersController();
				$controllers->updateProfil();
			});

			$router->post('/profil', function(){
					$controllers = new UsersController();
					$controllers->updateProfil($_POST);
			});

			// Writter
			$router->get('/show-my-posts', function(){
				if ($this->getGroupe() != 0){
					$controllers = new WritterController();
					$controllers->getPosts();
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->get('/delete-post/:id', function($id){
				$controllers = new ArticlesController();
				$controllers->deletePost($id);
			});

			$router->get('/add-post/', function(){
				if ($this->getGroupe() != 0){
					$controllers = new ArticlesController();
					$controllers->createPost();
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->post('/add-post/', function(){
				if ($this->getGroupe() != 0){
					$controllers = new ArticlesController();
					$controllers->addPost($_POST, $_FILES);
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->get('/update-post/:id', function($id){
				$controllers = new ArticlesController();
				$controllers->updatePost($id);
			});

			$router->post('/update-post/:id', function($id){
				$controllers = new ArticlesController();
				$controllers->updatePost($id, $_POST, $_FILES);
			});

			$router->get('/admin/users/', function(){
				if ($this->getGroupe() == 2){
				$controllers = new AdminController();
				$controllers->getUsers();
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->get('/admin/users/edit/:id', function($id){
				if ($this->getGroupe() == 2){
				$controllers = new AdminController();
				$controllers->updateProfilUser(NULL,$id);
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->post('/admin/users/edit/:id', function($id){
				if ($this->getGroupe() == 2){
					$controllers = new AdminController();
					$controllers->updateProfilUser($_POST);
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->get('/admin/users/remove/:id', function($id){
				if ($this->getGroupe() == 2){
				$controllers = new AdminController();
				$controllers->removeUser($id);
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->get('/admin/users/add/', function(){
				if ($this->getGroupe() == 2){
				$controllers = new AdminController();
				$controllers->addUser();
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->post('/admin/users/add/', function(){
				if ($this->getGroupe() == 2){
				$controllers = new AdminController();
				$controllers->addUser($_POST);
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});


			$router->get('/admin/posts/', function(){
				if ($this->getGroupe() == 2){
					$controllers = new AdminController();
					$controllers->getPosts();
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->get('/admin/category/', function(){
				if ($this->getGroupe() == 2){
					$controllers = new AdminController();
					$controllers->ManageCategory();
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->post('/admin/category/', function(){
				if ($this->getGroupe() == 2){
					$controllers = new AdminController();
					$controllers->ManageCategory($_POST);
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->get('/admin/category/:id', function($id){
				if ($this->getGroupe() == 2){
					$controllers = new AdminController();
					$controllers->deleteCategory($id);
				}else{
					$controllers = new UsersController();
					$controllers->forbidden();
				}
			});

			$router->run();
		}



		//______ SETTER _______ //

		public function setName($name)
		{
			if ( strlen($name) < 3 || strlen($name) > 15)
			{
				$this->message .="<p> Invalid name</p>";
				$this->statusOkay = false;
			}
			$this->name=$name;
		}

		protected function  setEmail($email)
		{
			if( filter_var($email, FILTER_VALIDATE_EMAIL) == false)
				{
					$this->message .="<p> Invalid email</p>";
					$this->statusOkay = false;
				}
			$this->email=$email;
		}

		protected function setPassword($password, $password_confirmation)
		{

			if(strcmp($password, $password_confirmation) != 0)
			{
				$this->message .="<p> Invalid password or password confirmation </p>";
				$this->statusOkay = false;
			}

			if ( strlen($password) < 3 || strlen($password_confirmation) > 10)
			{
				$this->message .="<p> Invalid password or password confirmation </p>";
				$this->statusOkay = false;
			}
			$password = password_hash($password, PASSWORD_DEFAULT);
			$this->password = $password;
		}


		protected function setImg($img)
		{

			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
			$extension_upload = strtolower(  substr(  strrchr($img['name'], '.')  ,1)  );

			if ($img['error'] > 0)
			{
				$this->message .= "<p>Erreur lors du transfert</p>";
				$this->statusOkay = false;
			}

			if ($img['size'] > 1048576)
			{
				$this->message .= "<p>Le fichier est trop gros</p>";
				$this->statusOkay = false;
			}

			if ($img['size'] == 0)
			{
				$this->message .= "<p>Problem with picture</p>";
				$this->statusOkay = false;
			}


			if ( !(in_array($extension_upload,$extensions_valides)) ){
				$this->message .= "<p>Bad extension</p>";
				$this->statusOkay = false;
			}
				$this->img=$img;

		}

		protected function mooveImage()
		{

			$urlImg = "../Webroot/img/";
			$urlImg .=$this->img['name'];
			$resultat = move_uploaded_file($this->img['tmp_name'],$urlImg);
			$urlImg = str_replace('../', '', $urlImg);
			$this->urlImg = 'http://localhost/PHP_Rush_MVC/'.$urlImg;
		}


	}
?>
