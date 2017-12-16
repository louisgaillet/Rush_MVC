<div class="container profil-user">
	<div class="row padding-top-large">
		<div class="col-md-4 col-sm-8 col-xs-12  offset-md-4 offset-sm-2 mini-form" >
			<?php
				$groupe = array(0=>"User", 1=>"Writer", 2=>'Admin');
				$status = array(0=>"actif", 1=>"banni");
				echo $form->start();
				echo $form->hidden('groupe',$user['Groupe']);
				echo $form->hidden('status',$user['Status']);
				echo $form->hidden('id',$user['Id']);
				echo $form->input('name',$user['Name']);
				echo $form->input('email',  $user['Email'] );
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