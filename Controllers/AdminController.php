<?php

include_once('../Models/Users/User.php');
include_once('../Models/Articles/Article.php');
include_once '../Models/Form.php';


	class AdminController extends AppController{

		public function __construct(){
			parent::__construct();
			$this->user = $this->model('User');
			$this->article = $this->model('Article');
			$this->viewPath = ROOT . 'Views/';
		}


		public function getUsers(){
			$data = $this->user->displayUsers();
			$this->render('Users/getAllUsers', compact('data'));
		}

		public function updateProfilUser($post=NULL, $id=NULL){

			$user = $this->user->getUser($id);
			if(isset($post['name'])){
				$groupe = intval($post['groupe-select']);
				$status = intval($post['status-select']);

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
					$this->user-> updateUser($post['id'], $this->name, $this->password, $this->email, $groupe, $status);
					$_SESSION['MessageConfirm'] = 'Profil à jour';
					header("Location: http://localhost/PHP_Rush_MVC/admin/users/");
				}
				else{
					$_SESSION['MessageError'] = $this->message;
				}

			}
				$form = new Form('profil/'.$id.'','', 'POST');
				$this->render('Admin/profil_user', compact('form', 'user') );

		}

		public function addUser($post =NULL){
			if($post == NULL){
				$form = new Form('','', 'POST');
				$this->render('Admin/add_user', compact('form') );
			}
			else{
				$name=$post['name'];
				$email=$post['email'];
				$password=$post['password'];
				$passwordConfirmation=$post['passwordConfirmation'];
				$this->setName(htmlspecialchars($name));
				$this->setEmail(htmlspecialchars($email));
				$this->setPassword($password, $passwordConfirmation);
				$groupe =$post['groupe'];
				$status =$post['status'];
				echo $groupe;
				echo $status;

				if($this->statusOkay == true){
					$_SESSION['MessageConfirm'] = "Inscription de  ".$name;
					$result=$this->user->createUser($name, $this->password, $email, $groupe, $status);
			       	header("Location: http://localhost/PHP_Rush_MVC/admin/users/add");
				}
				else{
					$_SESSION['MessageError'] = $this->message;
					header("Location: http://localhost/PHP_Rush_MVC/admin/users/add");
				}
				//$this->render('Admin/add_user', compact('form') );
			}
		}

		public function removeUser($id){
			$action = $this->user->deleteUser($id);
			if($action == true){
				$_SESSION['MessageConfirm'] = 'Utilisateur supprimé';
			}
			else{
				$_SESSION['MessageConfirm'] = "Impossible de supprimé l'utilisateur";
			}
			header("Location: http://localhost/PHP_Rush_MVC/admin/users/");
		}



		public function getPosts()
		{

			$data=$this->article->displayPostbyDate();
			$this->render('Admin/getAllPost', compact('data') );
		}

		public function ManageCategory($post=null){
			if ($post == null){
				$data = $this->article->getCategories();
				$form = new Form('','./', 'POST');
				$this->render('Admin/categories', compact('data','form'));
			} else {
				$insert=$this->article->addCategory($post['name']);
				if ($insert == true) {
					$_SESSION['MessageConfirm'] = "La catégorie ".$post['name']." a bien été créé.";
				} else {
					$_SESSION['MessageError'] = "La catégorie ".$post['name']." n'a pu être créé.";
				}
				header("Location: http://localhost/PHP_Rush_MVC/admin/category/");
			}
		}

		public function deleteCategory($id){
			$result=$this->article->deleteCategory($id);
			if ($result == true){
				$_SESSION['MessageConfirm'] = "La catégorie a bien été supprimé.";
			} else {
				$_SESSION['MessageError'] = "La catégorie n'a pu être supprimé.";
			}
			header("Location: http://localhost/PHP_Rush_MVC/admin/category/");
		}

	}
 ?>
