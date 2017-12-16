<div class=" blog">

	<div class="row">
		<div class="container text-right order-by">
				<h6> Trier par </h6>
				<a href="http://localhost/PHP_Rush_MVC/blog/order-by-title">Titre</a>
				<a href="http://localhost/PHP_Rush_MVC/blog/order-by-date">Date</a>
				de création</label>
		</div>

	</div>
	<div class="row">
<?php
	foreach ($data as $value){
		?>

    <?php
    // pour limiter l'affichage du content de l'article
    $apercu = substr($value['Content'], 0, 200) . "..." ?>

		<article class="col-md-4 post-list-item">
			<a href="http://localhost/PHP_Rush_MVC/post/<?php echo $value['Id'] ?>" class="wrapper-post">
				<div class="header-post">
					<img src=<?php echo $value['Image'] ?> alt="<?php echo $value['Title'] ?>">
				</div>
				<div class="content-post">
					<h3 class="post-title"><?php echo $value['Title'] ?></h3>
	 				<p class="post-intro"><?php echo $apercu ?></p>
				</div>
			</a>
	 	</article>
		<?php
	}
 ?>
</div>
</div>
