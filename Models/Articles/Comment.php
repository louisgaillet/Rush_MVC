<?php
include_once '../Config/Db.php';

// management des articles du blog
class Comment
{

  function __construct(){
    $db = Connexion::getInstance();
    $this->bdd = $db->getBdd();
  }

  public function addComment($content, $authorid, $articleid){
      $query = $this->bdd->prepare("INSERT INTO Comments(Content, Author_id, Article_id) VALUES (?, ?, ?)");

      $query->execute(array($content, $authorid, $articleid));

      if($query){
        return true;
      }
      else{
        return false;
      }
    }

    public function getComments($articleid){
      $query = $this->bdd->prepare("SELECT Comments.Content, users.Name FROM Comments JOIN users ON Comments.Author_id=users.Id WHERE Comments.Article_id=? ORDER BY Comments.Id DESC");
      $query->execute(array($articleid));
      $tab = $query->fetchAll();
      return $tab;
    }

  }
?>
