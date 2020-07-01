<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Se connecter</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="Public/Login-Package/images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/fonts/iconic/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/vendor/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/vendor/animsition/css/animsition.min.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/vendor/daterangepicker/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/css/util.css">
		<link rel="stylesheet" type="text/css" href="Public/Login-Package/css/main.css">
	</head>

	<body>		
		<?php require'Public/Header/Header.php'; ?>

		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<form method="POST" action="http://localhost/easy_food/login" class="login100-form validate-form">
						<span class="login100-form-title p-b-26">
							Bienvenue sur Easy Food !
						</span>
						<span class="login100-form-title p-b-48">
							<i class="zmdi zmdi-font"></i>
						</span>



						<!-- SAISIE MAIL!-->
						
						<?php if($data['loginn']['erreur']==true)
								{ ?>
									<p class="email_exist">Mauvais email ou mot de passe</p>
						<?php
								} ?>
						<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
							<input class="input100" type="text" name="email"> <!-- MAIL !-->
							<span class="focus-input100" data-placeholder="Email"></span>
							
						</div>


						<!-- SAISIE PASSWORD!-->

						<div class="wrap-input100 validate-input" data-validate="Enter password">
							<span class="btn-show-pass">
								<i class="zmdi zmdi-eye"></i>
							</span>
							<input class="input100" type="password" name="pass"> <!-- MAIL !-->
							<span class="focus-input100" data-placeholder="Password"></span>
						</div>




						<div class="container-login100-form-btn">
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								<button class="login100-form-btn">
									Connexion
								</button>
							</div>
						</div>

						<div class="text-center p-t-115">
							<span class="txt1">
								Vous n'avez pas de compte ?
							</span>

							<a class="txt2" href="http://localhost/easy_food/inscription"/>
								Inscription
							</a>
							<a class="txt2" href="http://localhost/easy_food/login/password"/>
								mot de passe oublié ?
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		

		<div id="dropDownSelect1"></div>
		
	<!--===============================================================================================-->
		<script src="vu/package_login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="vu/package_login/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
		<script src="vu/package_login/vendor/bootstrap/js/popper.js"></script>
		<script src="vu/package_login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="vu/package_login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<script src="vu/package_login/vendor/daterangepicker/moment.min.js"></script>
		<script src="vu/package_login/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
		<script src="vu/package_login/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
		<script src="vu/package_login/js/main.js"></script>
		
	</body>
</html>