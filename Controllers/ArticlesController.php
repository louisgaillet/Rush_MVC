	<?php
include_once('../Models/Articles/Article.php');
include_once '../Models/Form.php';
include_once('../Models/Articles/Comment.php');




	class ArticlesController extends AppController
	{

		protected $article;

		public function __construct()
		{
			parent::__construct();
			$this->article = $this->model('Article');
			$this->comment = $this->model('Comment');
			$this->viewPath = ROOT . 'Views/';
			//session_start();
		}

		// Function
		public function displayPosts()
		{
			$data=$this->article->displayPosts();
			$this->render('Articles/listPost', compact('data'));
		}

		public function displayPostbyTile()
		{
			$data=$this->article->displayPostbyTitle();
			$this->render('Articles/blog', compact('data'));
		}

		public function displayPostbyDate()
		{
			$data=$this->article->displayPostbyDate();
			$this->render('Articles/blog', compact('data'));
		}


		public function displayPostsForBlog(){
			$data=$this->article->displayPosts();
			$form = new Form('','./', 'POST');
			$this->render('Articles/blog', compact('data','form'));
		}

		public function getPost($id)
		{
			$form = new Form('','', 'POST');
			$data=$this->article->getPost($id);
			$comment = $this->comment->getComments($id);
			// !! Getcategory(postId);
			$this->render('Articles/singlePost',compact('data', 'category', 'form', 'comment'));
		}


	public function createPost()
		{
			$form = new Form('','http://localhost/PHP_Rush_MVC/add-post', 'POST');
			$category = $this->article->getCategories();
			$this->render('Articles/addPost', compact('form', 'category') );

		}
		public function addPost($data, $file )
		{
			$img = $file['image'];
			$title = htmlspecialchars($data['title']);
			$content = htmlspecialchars($data['content']);
			$tags = htmlspecialchars($data['tags']);
			$image = $this->setImg($img);
			$this->mooveImage();
			$category = htmlspecialchars($data['category']);


			$idAutor = Session::read('Auth','Id');

			if($this->statusOkay == true){
				$posts=$this->article->addPost($title,$content,$this->urlImg,$idAutor,$category,$tags);
			 	if($posts == true){
			 		$_SESSION['MessageConfirm'] = "L'article ".$title." a été créé";
			 	}
			 	}else{
			 		$_SESSION['MessageConfirm'] = "L'article ".$title." a été créé";
			 	}
			 $idAutor = Session::read('Auth','Id');
			 header("Location: ./add-post/");

		}

		public function updatePost($id, $post=NULL, $file=NULL)
		{

			$dataPost = $this->article->getPost($id);
			if ($post == NULL){
				// Si la personne connecté == authorId
				if($dataPost['Author_id'] == Session::read('Auth','Id') || ($this->getGroupe() == 2) ){
					$form = new Form('','./'.$id, 'POST');
					$category = $this->article->getCategories();
					$this->render('Articles/updatePost', compact('post','form', 'category','dataPost') );
				}
				else{
					$this->render('Users/forbidden', compact('') );
				}

			}else{
				$title = htmlspecialchars($post['title']);
				$content = htmlspecialchars($post['content']);
				$tags = htmlspecialchars($post['tags']);
				if ($file['name'] == "") {
					$this->urlImg = $dataPost['Image'];
				}
				else{
					$img = $file['image'];
					$image = $this->setImg($img);
					if($this->statusOkay == true){
						$this->mooveImage();
					}
				}
				$category = htmlspecialchars($post['category']);
				$idAutor = $dataPost['Author_id'];
				
				$return = $this->article->updatePost($id,$title,$content,$this->urlImg,$category,$tags);
				if($return == true){
					$_SESSION['MessageConfirm'] = "L'article ".$title." a été mis à jour";
				}else{
					$_SESSION['MessageError'] = "L'article ".$title." n'a pu être mis à jour";
				}
				header("Location: http://localhost/PHP_Rush_MVC/show-my-posts");

			}
		}



		public function deletePost($id)
		{
			// Faire les verifs de droits
			$post = $this->article->deletePost($id);
			if($post == true){
					$_SESSION['MessageConfirm'] = "L'article et ses commentaires associés ont été supprimés";
				}else{
					$_SESSION['MessageError'] = "L'article et ses commentaires associés n'ont pu être supprimés";
				}
			if ($this->getGroupe() == 1){
				header("Location: http://localhost/PHP_Rush_MVC/show-my-posts");
			}else{
				header("Location: http://localhost/PHP_Rush_MVC/admin/posts/");
			}
		}



	}
?>
