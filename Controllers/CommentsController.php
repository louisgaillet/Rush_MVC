<?php
include_once('../Models/Articles/Comment.php');
include_once '../Models/Form.php';

	class CommentsController extends AppController
	{

		protected $comment;

		public function __construct()
		{
			parent::__construct();
			$this->comment = $this->model('Comment');
			$this->viewPath = ROOT . 'Views/';
			//session_start();
		}


    public function addComment($postId, $post){
      $author_id = Session::read('Auth','Id');
      $result = $this->comment->addComment($post['comment'], $author_id, $postId);
      if ($result == true){
        $_SESSION['MessageConfirm'] = "Merci pour ton commentaire";
      }
      else {
        $_SESSION['MessageError'] = "Il y a eu un petit problème lors de l'ajout de ton commentaire :(";
      }

      header("Location:http://localhost/PHP_Rush_MVC/post/".$postId);

    }


	}
?>
