<div class="add-post">
	<div class="container">
		<div class="row padding-top-large">
			<div class=" col-xs-12 title-page ">
				<h2>Ajouter un nouvel article</h2>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12  offset-md-2 offset-sm-2 " >
				<?php 
					echo $form->startWIthFile( );
					echo $form->input('title' );
					echo $form->textarea('content');
					echo $form->file('image');
					echo $form->select('category', $category);
					echo $form->input('tags', '');
					echo $form->submit();
					echo $form->end( );
				 ?>
			</div>
		</div>
	</div>
</div>
