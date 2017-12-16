<div class="row homepage">
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

					<span class="categories"> <?php echo $value['Cat'] ?></span>
					<p class="info-post"> Par: <?php echo $value['Name'] ?></h5>
					<p class="info-post"> Date de création : <?php echo $value['Date_creation'] ?></h6>
				</div>
			</a>
	 	</article>
		<?php
	}
 ?>
</div>
