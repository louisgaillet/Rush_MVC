------------------------Models------------------------
	- Article
		- public function getPost() => Return array
		- public function getPost($id) => Return array 
	    - pulic function addPost($id) => return string( sucess : No-sucess)
		- pulic function deletePost($id) => return string( sucess : No-sucess)
		- public function updatePost($id) => return string( sucess : No-sucess)
		- public function getComments($idPost) => return array

	- User
		public function getPass($email) => Return pass
		public function getId($email) => return id
		public function addUser(Name, Password(crypté), Email, Groupe, Status, Date creation) => Return 'sucess' : 'echec'
		public function getData($id) => return array data users (name,Password(crypté), Email ...)
		public function updateUser(Name, Password(crypté), Email, Groupe, Status, Date_edition) => Return 'sucess' : 'echec'
		



	
------------------------Consctructeur------------------------
	AppController
		// Charge le model adequat ex: ArticlesController charge le modele Articles
		-public function model($model){
			return new $model();
		}

		- public function render($viewName, $data){
			require($this->viewPath.str_replace('.', '/', $view).'.tpl');
		
		-public beforeRender() => ?
		-protected function redirect($param); => ?
		}

	ArticlesController
		-public function getPosts() => render(viewName, $data)
		-public AddPost() => render true : false
	
	ArticleController
		-public function getPost() => render(viewName, $data)
		-public function getComments($idPost) => => render(viewName, $data)
		-public addPost($name ...)

	UserController
<?php 
	
	class UsersController{


		protected $statusOkay = true;


		public function login($login, $password)
			{

		}

		-public function register($name, $email, $password, $passwordConfirmation)
		{
			model->Users/user ->createUser($name, $email, $password, 0, 0)		
		}


		- public function setName($name){ retur bool}

		- protected function  setEmail($email) { return bool}
		
		- protected function setPassword($password, $passConfirmation ) {return bool}


	}
 ?>




------------------------Views------------------------

	

-------------------------RESTE A FAIRE ---------------


