<?php 
if (Session::read('Auth','Id')) {
	$menu_secondary = "
	<li class='nav-item'><a href='http://localhost/PHP_Rush_MVC/profil' class='nav-link'><i class='fa fa-user' aria-hidden='true'></i></a></li>
	<li class='nav-item'><a href='http://localhost/PHP_Rush_MVC/logout/' class='nav-link'><i class='fa fa-sign-out' aria-hidden='true'></i></a></li> 
	";
}else{
	$menu_secondary = "<li class='nav-item'><a href='http://localhost/PHP_Rush_MVC/login' class='nav-link'>Login</a></li>
					<li class='nav-item'><a href='http://localhost/PHP_Rush_MVC/register' class='nav-link'>S'enregistrer</a></li>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800|Prata" rel="stylesheet">
	<link rel="stylesheet" href="http://localhost/PHP_Rush_MVC/Webroot/css/global.css">
	<link rel="stylesheet" href="http://localhost/PHP_Rush_MVC/Webroot/css/posts.css">
	<link rel="stylesheet" href="http://localhost/PHP_Rush_MVC/Webroot/css/page.css">
	<link rel="stylesheet" href="http://localhost/PHP_Rush_MVC/Webroot/css/admin.css">
	<script src="https://use.fontawesome.com/0622a1b619.js"></script>
</head>
<body>

	<header>
		<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse bg-faded fixed-top mr-auto">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="http://localhost/PHP_Rush_MVC/">Home</a>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto ">
					<li class='nav-item'><a href="http://localhost/PHP_Rush_MVC/show-my-posts" class="nav-link">Mes articles</a></li>
					<li class='nav-item'><a href="http://localhost/PHP_Rush_MVC/add-post" class="nav-link">Ajouter un article</a></li>
					<li class='nav-item'><a href="http://localhost/PHP_Rush_MVC/admin/users/" class="nav-link">Utilisateurs</a></li>
					<li class='nav-item'><a href="http://localhost/PHP_Rush_MVC/admin/posts/" class="nav-link">Articles</a></li>
					<li class='nav-item'><a href="http://localhost/PHP_Rush_MVC/admin/category/" class="nav-link">Categories</a></li>
					
				</ul>
					<form class="form-inline my-2 my-lg-0">
				      <input class="form-control mr-sm-2" type="text" placeholder="Search">
				      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				    </form>
				  <ul class="navbar-nav mr-auto menu_secondary">
				  	<?php echo $menu_secondary; ?>
				  </ul>
			</div>
		</nav>
	</header>


	<div class="wrapper-site  container-fluid">
		<?php 
		if (isset($_SESSION['MessageError'])) {?>
			<div class="alert alert-danger">
			  <?php echo $_SESSION['MessageError']; ?>
			</div>
		<?php };

		if (isset($_SESSION['MessageConfirm'])) {?>
			<div class="alert alert-success">
			  <?php echo $_SESSION['MessageConfirm']; ?>
			</div>
		<?php };
		Session::delete('MessageConfirm');
		Session::delete('MessageError');
		echo $content ;
		?>
	</div>

	<footer>
		<p>Developpement web Jean-Yves Brisset & Louis Gaillet</p>
	</footer>


<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <script src="http://localhost/PHP_Rush_MVC/Webroot/js/user.js"></script>
  <script src="http://localhost/PHP_Rush_MVC/Webroot/js/global.js"></script>
  <script src="http://localhost/PHP_Rush_MVC/Webroot/js/jquery.uploadPreview.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="http://localhost/PHP_Rush_MVC/Webroot/js/ajax-product.js"></script>
  
</body>
</html>