<div class="container add-user profil-user">
	<div class="row padding-top-large">
		<div class="col-md-4 col-sm-8 col-xs-12  offset-md-4 offset-sm-2 mini-form" >
			<?php
				$groupe = array(0=>"User", 1=>"Writer", 2=>'Admin');
				$status = array(0=>"actif", 1=>"banni");
				echo $form->start();
				echo $form->hidden('groupe', 0);
				echo $form->hidden('status', 0);
				echo $form->hidden('id');
				echo $form->input('name');
				echo $form->input('email' );
				echo $form->selectSimple('groupe-select', $groupe);
				echo $form->selectSimple('status-select', $status);
				echo $form->password('password' );
				echo $form->password('passwordConfirmation' );
				echo $form->submit();
				echo $form->end();
			 ?>
		</div>
	</div>
</div>