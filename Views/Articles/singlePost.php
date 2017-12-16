<div class='single-post'>
	<div class="post-header">
		<img src="<?php echo $data['Image'] ?>" alt="">
	</div>
	<div class="post-content container">
		<h1><?php echo $data['Title'] ?></h1>
		<h3> Par: <?php echo $data['Name'] ?></h3>
		<h5>Catégorie: <?php echo $data['Cat'] ?></h5>
		<h6>Le : <?php echo $data['Date_creation'] ?></h6>
  		<p><?php echo $data['Content']?></p>
	</div>
</div>



<div class="container comments">
	<?php $commentnb = count($comment) ?>
	<h2><?php echo $commentnb ?> Commentaire<?php if($commentnb >1){ echo "s";} ?></h2>
	<?php foreach ($comment as $value): ?>
		<div class="item-comments">
			<div class="header-comment">
				<p><?php echo $value['Name'] ?></p>
			</div>
			<div class="body-comment">
				<p><?php echo $value['Content'] ?></p>
			</div>

	</div>


	<?php endforeach; ?>

	<h2>Ajouter un commentaire</h2>
	<?php

			echo $form->start();
			echo $form->textarea('comment');
			echo $form->submit();
			echo $form->end();
	 ?>
</div>
