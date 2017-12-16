<?php

//générateur de formulaire

class Form {

  private $data;
  private $action;
  private $method;

  public function __construct($data = array(), $action, $method){

    $this->data = $data;
    $this->action = $action;
    $this->method = $method;

  }



  public function start()
  {
    echo '<form action="' . $this->action . '" method="' . $this->method . '">';
  }

  public function startWIthFile()
  {
    echo '<form action="' . $this->action . '" method="'. $this->method.'"enctype="multipart/form-data">';
  }

    public function end()
  {
    echo '</form>';
  }

  private function surroundP($html){
    return '<div class="form-group" > <p>' . $html . '</p> </div>';
  }

  public function input($name, $value=NULL){
    return $this->surroundP('<input type="texte" class="form-control " name="' . $name . '" value="' . $value .'" placeholder="' . $name .'">');
  }

  public function hidden($name, $value=NULL){
    return $this->surroundP('<input type="hidden" class="form-control" name="' . $name . '" value="' . $value .'" placeholder="' . $name .'">');
  }

    public function password($name, $value=NULL){
    return $this->surroundP('<input type="password" class="form-control" name="' . $name . '" value="' . $value .'" placeholder="' . $name .'">');
  }

  public function textarea($name, $value=NULL){
    return $this->surroundP('<textarea name="' . $name . '"  class="form-control cols="30" rows="10">' . $value . '</textarea>');
  }

   public function file($name, $value=NULL){
    return $this->surroundP('<label class="file"><input type="file" class="-file-input input-group input-file" name="' . $name . '" value="' . $value .'" placeholder="' . $name .'"> </label>');
  }


  public function select($name, $array){

    $select = '';
    $select .="<option selected  value='0'>".$name."</option>";

    foreach ($array as $value) {
      $select .= '<option value="' . $value["Id"] . '">' . $value["Title"] . '</option>';
    }

    return $this->surroundP('<select name="' . $name . '" class="form-control">' . $select . '</select>');
  }

  public function selectSimple($name, $array){

    $select = '';
    $select .="<option selected  value='null'>".$name."</option>";

    foreach ($array as $key => $value) {
      $select .= '<option value="' . $key . '">' . $value . '</option>';
    }

    return $this->surroundP('<select name="' . $name . '" class="form-control">' . $select . '</select>');
  }

  public function submit(){
    return $this->surroundP('<button type="submit" class="btn btn-primary">Envoyer</button>');
  }

}

?>
