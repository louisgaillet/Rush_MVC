<div class="row padding-top-large">
	<div class=" col-xs-12 title-page ">
		<h2>Utilisateurs du blog</h2>	
	</div>
	<div class="add-user col-xs-12">
		<a href="./add" class="btn btn-primary">Ajouter un utilisateur</a>
	</div>
	<div class="container">
		<ul class="list-group">
			<?php 
			foreach ($data as $value) {?>
			<li class="list-group-item flex">
				<p><?php echo $value['Name']; ?></p>
				<div class="buttons">
					<a href="./edit/<?php echo $value['Id'] ?>" class="btn btn-info">Editer</a>
					<a href="./remove/<?php echo $value['Id'] ?>" class="btn btn-danger">Supprimer</a>
				</div>
			</li>
			<?php }?>
		</ul>
	</div>
</div>