<?php
include_once '../Config/Db.php';


// management des usagers
class User
{

  function __construct(){
    $db = Connexion::getInstance();
    $this->bdd = $db->getBdd();
  }

  //METHODES
  //afficher tout les usagers dans un tableau
  public function displayUsers(){
    $query = $this->bdd->prepare("SELECT * FROM users ORDER BY Date_creation DESC");
    $query->execute();
    $tab = $query->fetchAll();
    return $tab;
  }

  //sélectionner un usager avec son ID
  public function getUserByEmail($email){
    $query = $this->bdd->prepare("SELECT * FROM users WHERE Email= ?");
    $query->execute(array($email));
    $tab = $query->fetch(PDO::FETCH_ASSOC);
    return $tab;
  }

  //sélectionner un usager avec son ID
  public function getUser($id){
    $query = $this->bdd->prepare("SELECT * FROM users WHERE Id= ?");
    $query->execute(array($id));
    $tab = $query->fetch(PDO::FETCH_ASSOC);
    return $tab;
  }

  //créer un usager
  public function createUser($name, $password, $email, $groupe=0, $status=0){
    $query = $this->bdd->prepare("INSERT INTO users(Name, Password, Email, Groupe, Status, Date_creation) VALUES (?, ?, ?, ?, ?, CURDATE())");
    $query->execute(array($name, $password, $email, $groupe, $status));

    if($query){
      return true;
    }
    else{
      return false;
    }
  }

  //mettre à jour un usager
  public function updateUser($id, $name, $password, $email, $groupe, $status){
    var_dump($groupe);
  $query = $this->bdd->prepare("UPDATE users SET Name=?, Password=?, Email=?, Date_edition= CURDATE(), Groupe=?, Status=? WHERE Id=?");
  $query->execute(array($name, $password, $email, $groupe, $status, $id));

  if($query){
    return true;
  }
  else {
    return false;
  }
}

  //supprimer un usager
  public function deleteUser($id){
    $query = $this->bdd->prepare("DELETE FROM users WHERE Id= ?");
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
