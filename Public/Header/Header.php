
<!------ INCLURE LES LIENS/LIBRAIRIES POUR LE TEMPLATE MENU !---------->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="Public/Header-Package/css/shop-homepage.css" rel="stylesheet">

    	<script src="Public/Header-Package/vendor/jquery/jquery.min.js"></script>
    	<script src="Public/Header-Package/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	    <link rel="stylesheet" href="Public/Font-Awesome/css/font-awesome.min.css">

	</head>

	<body>
		<header class="mb-2">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
				<div class="container">
					<a class="navbar-brand" href="http://localhost/easy_food">Easy Food</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarResponsive">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item active">
								<?php
									if(isset($_SESSION['prenom']))
									{
										if(isset($_SESSION['admin']))
										{ ?>
											<a href="http://localhost/easy_food/administrateur"><span class="nav-link"><?= $_SESSION['prenom']; ?></span></a>
								<?php 	}

											else
											{
											?>
												<a><span class="nav-link"><?= $_SESSION['prenom']; ?></span></a>
									<?php }
									
									}

										 else
										 {
										 	echo'<a class="nav-link" href="http://localhost/easy_food/login">Connexion</a>';
										 }
									
								?> 
							</li>

							<li class="nav-item active">
								<a class="nav-link" href="http://localhost/easy_food/panier"><i class="fa fa-shopping-cart"></i></a>
							</li>

							<li class="nav-item active">
								<?php 
									if(isset($_SESSION['prenom']))
									{?>
										<a class="nav-link" href="http://localhost/easy_food/login/deconnexion">Deconnexion
											<span class="sr-only"></span>
										</a>
								<?php
									}
								?>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
	</body>
</html>

