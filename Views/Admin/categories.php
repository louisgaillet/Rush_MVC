<div class="row padding-top-large">
  <div class="col-xs-12 title-page">
  <h3>Liste des categories:</h3>
</div>
  <ul class= "list-group container">
  <?php
  foreach ($data as $value): ?>
    <li class="list-group-item flex">
    <h3> <?php echo $value['Title'] ?></h3>
    <div>
    <a href="./<?php echo $value['Id'] ?>" class="btn btn-danger">Supprimer</a>
    </div>
  </li>
  <?php endforeach; ?>
  </ul>

<div class="container">
  <div class="wrapper-add-category">
  <h3 class="text-center">Ajouter une nouvelle catégorie</h3>

  <?php
  echo $form->start();
  echo $form->input('name');
  echo $form->submit();
  echo $form->end();
  ?>
</div>
</div>

</div>
