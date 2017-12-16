
<?php
include_once '../Config/Db.php';

// management des articles du blog
class Article
{

  function __construct(){
    $db = Connexion::getInstance();
    $this->bdd = $db->getBdd();
  }

  //METHODES
  //afficher tout les articles dans un tableau
  public function displayPosts(){
    $query = $this->bdd->prepare("SELECT Article.Id, Article.Image, Article.Title, Article.Content, Article.Date_creation, Article.Date_edition, users.Name, Category.Title AS Cat FROM Article JOIN users ON Article.Author_id=users.Id JOIN Category ON Article.Category_id=Category.Id ORDER BY Article.Id DESC");
    $query->execute();
    $tab = $query->fetchAll();
    return $tab;
  }


  //afficher tout les articles dans un ordre precis
  public function displayPostbyTitle(){
    $query = $this->bdd->prepare("SELECT * FROM Article ORDER BY Title DESC");
    $query->execute();
    $tab = $query->fetchAll();
    return $tab;
  }


    //afficher tout les articles dans un ordre precis
  public function displayPostbyDate(){
    $query = $this->bdd->prepare("SELECT * FROM Article ORDER BY Date_creation DESC");
    $query->execute();
    $tab = $query->fetchAll();
    return $tab;
  }


  //sélectionner un article avec son ID
  public function getPost($id){
    $query = $this->bdd->prepare("SELECT Article.Id,Article.Category_id ,Article.Tags,Article.Author_id, Article.Image, Article.Title, Article.Content, Article.Date_creation, Article.Date_edition, users.Name, Category.Title AS Cat FROM Article JOIN users ON Article.Author_id=users.Id JOIN Category ON Article.Category_id=Category.Id WHERE Article.Id=?");
    $query->execute(array($id));
    $tab = $query->fetch(PDO::FETCH_ASSOC);
    return $tab;
  }

  //sélectionner un article avec son Author_ID
  public function getPostByAuthor($id){
    $query = $this->bdd->prepare("SELECT * FROM Article WHERE Author_id= ? ORDER BY Date_creation DESC");
    $query->execute(array($id));
    $tab = $query->fetchAll();
    return $tab;
  }

  //poster un article
  public function addPost($title, $content, $img, $author, $cat=NULL, $tag=NULL){
    $query = $this->bdd->prepare("INSERT INTO Article(Title, Content, Image, Author_id, Date_creation, Category_id, Tags) VALUES (?, ?, ?, ?, CURDATE(), ?, ?)");

    $query->execute(array($title, $content, $img, $author, $cat, $tag));

    if($query){
      return true;
    }
    else{
      return false;
    }
  }

  //editer un article
  public function updatePost($id, $title, $content, $img, $category=NULL, $tags=NULL){
    $query = $this->bdd->prepare("UPDATE Article SET Title=?, Content=?, Image=?, Date_edition= CURDATE(), Category_id=?, Tags=? WHERE Id=?");
    $query->execute(array($title, $content, $img, $category, $tags, $id));
    if($query){
      return true;
    }
    else {
      return false;
    }
  }

//supprimer un article
  public function deletePost($id){
    $query = $this->bdd->prepare("DELETE FROM Article WHERE Id= ?");
    $query->execute(array($id));

    $kouery = $this->bdd->prepare("DELETE FROM Comments WHERE Article_id = ?");
    $kouery->execute(array($id));

    if ($query && $kouery) {
      return true;
    }
    else {
      return false;
    }
  }


  //lister les catégories d'article disponible (pour les formulaires par exemple)
  public function getCategories(){
    $query = $this->bdd->prepare("SELECT * FROM Category");
    $query->execute();
    $tab = $query->fetchAll();
    return $tab;
  }

  public function addCategory($newCat){
    $query = $this->bdd->prepare("INSERT INTO Category (Title) VALUES (?)");
    $query->execute(array($newCat));
    if ($query) {
      return true;
    }
    else {
      return false;
    }
  }

  public function deleteCategory($id){
    $query = $this->bdd->prepare("DELETE FROM Category WHERE Id=?");
    $query->execute(array($id));
    if ($query) {
      return true;
    }
    else {
      return false;
    }

  }

}

?>
