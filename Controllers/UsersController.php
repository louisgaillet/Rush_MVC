<?php 

include_once('../Models/Users/User.php');
include_once '../Models/Form.php';
include_once '../Src/Session.php';


	class UsersController extends AppController{

		public function __construct()
		{
			parent::__construct();
			$this->user = $this->model('User');
			$this->viewPath = ROOT . 'Views/';
		}

		public function login($post)
		{
			$userDetail = $this->user->getUserByEmail($post['email']);

			if (password_verify ($post['password'],$userDetail['Password']) ) {
				unset($userDetail['Password']);
				$this->logout();
				Session::write('Auth',$userDetail);
				$_SESSION['MessageConfirm'] = "Bienvenue ".$userDetail['Name'];
		       	header("Location: http://localhost/PHP_Rush_MVC/");
		      }
		      else{
		        $_SESSION['MessageError'] = "Mauvaise conbinaision Email/password ";
		        header("Location: http://localhost/PHP_Rush_MVC/login");
		      }
			}

		public function register($post, $groupe=0, $status=0)
		{
			$name=$_POST['name'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			$passwordConfirmation=$_POST['passwordConfirmation'];
			$this->setName(htmlspecialchars($name));
			$this->setEmail(htmlspecialchars($email));
			$this->setPassword($password, $passwordConfirmation);
			
			if($this->statusOkay == true){
				$_SESSION['MessageConfirm'] = "Bienvenue ".$name;
				$result=$this->user->createUser($name, $this->password, $email, $groupe, $status);
				$userDetail = $this->user->getUserByEmail($this->email);
				Session::write('Auth',$userDetail);
		       	header("Location: http://localhost/PHP_Rush_MVC/");
			}
			else{
				$_SESSION['MessageError'] = $this->message;
				echo $this->message;
				header("Location: http://localhost/PHP_Rush_MVC/register");
			}
		}

		public function postRegister($action,$method)
		{
			$form = new Form('',$action, $method);
			$this->render('Users/addUser', compact('form') );
		}


		public function postLogin($action,$method)
		{
			$form = new Form('',$action, $method);
			$this->render('Users/login', compact('form') );
		}

		public function updateProfil($post=NULL, $groupe=0, $status=0)
		{	
			$id = Session::read('Auth','Id');
			$user = $this->user->getUser($id);

			if(isset($post['name'])){

				$this->setName(htmlspecialchars($post['name']));
				$this->setEmail(htmlspecialchars($post['email']));

				if($post['password'] !== ''){
					$password=$post['password'];
					$passwordConfirmation=$post['passwordConfirmation'];
					$this->setPassword($password, $passwordConfirmation);
				}else{
					$this->password = $user['Password'];
				}

				if($this->statusOkay == true){
					$this->user-> updateUser($id, $this->name, $this->password, $this->email, $groupe, $status);
					$_SESSION['MessageConfirm'] = 'Profil à jour';
				}
				else{
					$_SESSION['MessageError'] = $this->message;
				}
				$userDetail = $this->user->getUserByEmail($post['email']);
				unset($userDetail['Password']);
				Session::write('Auth',$userDetail);
				header("Location: ./profil");

			}
				$form = new Form('profil/'.$id.'','', 'POST');
				$this->render('Users/profil', compact('form', 'user') );
		}

		public function logout(){
			Session::delete('Auth');
			$_SESSION['MessageConfirm'] = "A bientôt ";
			header("Location: http://localhost/PHP_Rush_MVC/");
		}

		public function forbidden (){
			$this->render('Users/forbidden', compact('') );
		}

	}
 ?>