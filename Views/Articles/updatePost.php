<div class="add-post update-post">
	<div class="container">
		<div class="row padding-top-large">
			<div class=" col-xs-12 title-page ">
				<h2>Modifier <?php echo $dataPost['Title'] ?></h2>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12  offset-md-2 offset-sm-2 " >
				<?php
				echo $form->startWIthFile( );
				echo $form->hidden('valueCategory',$dataPost['Category_id']);
				echo $form->input('title', $dataPost['Title']);
				echo $form->textarea('content', $dataPost['Content']);
				echo $form->file('image', $dataPost['Image']);
				?> <div class="loading-picture"><img src="<?php echo $dataPost['Image'] ?>" alt=""> <span class="delete"><i class="fa fa-trash" aria-hidden="true"></i></span></div>
				<?php 
				echo $form->select('category', $category);
				echo $form->input('tags','');
				echo $form->submit();
				echo $form->end();
			 ?>
			</div>
		</div>
	</div>
</div>

