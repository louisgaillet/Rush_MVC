<div class=" login">
	<div class="container">
		<div class="row padding-top-large">
			<div class="col-md-4 col-sm-8 col-xs-12  offset-md-4 offset-sm-2 mini-form" >
				<?php
					echo $form->start( );
					echo $form->input('email' );
					echo $form->password('password' );
					echo $form->submit();
					echo $form->end( );
				 ?>
			</div>
		</div>
	</div>
</div>
