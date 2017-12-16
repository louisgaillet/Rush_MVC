<div class="container profil">
	<div class="row padding-top-large">
		<div class="col-md-4 col-sm-8 col-xs-12  offset-md-4 offset-sm-2 mini-form" >
			<?php
				echo $form->start();
				echo $form->input('name',$user['Name']);
				echo $form->input('email',  $user['Email'] );
				echo $form->password('password' );
				echo $form->password('passwordConfirmation' );
				echo $form->submit();
				echo $form->end();
			 ?>
		</div>
	</div>
</div>