<div class="row padding-top-large">
	<div class=" col-xs-12 title-page ">
		<h2>Mes articles</h2>
	</div>
	<ul class="list-group container">
<?php 
	foreach ($data as $value) {
		?>
		<li class="list-group-item flex">
			<h3><?php echo $value['Title'] ?></h3>
			<div class="buttons">
				<a href="http://localhost/PHP_Rush_MVC/update-post/<?php echo $value['Id'] ?>" class="btn btn-info">Editer</a>
	 			<a href="http://localhost/PHP_Rush_MVC/delete-post/<?php echo $value['Id'] ?>" class="btn btn-danger">Supprimer</a>
			</div>
		</li>
		<?php 
	}
 ?>
 </ul>
</div>
