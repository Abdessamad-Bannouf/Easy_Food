<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title>Mot de pass oublié</title>

			<link rel="stylesheet" href="../Public/Password-Package/style.css"/>
	    	<link rel="stylesheet" href="../Public/Font-Awesome/css/font-awesome.min.css">
	    	
			<link rel="stylesheet" type="text/css" href="../Public/Bootstrap/css/bootstrap.min.css">
			<script type="text/javascript" src="../Public/Bootstrap/js/bootstrap.min.js"></script>

			<link rel="stylesheet" type="text/css" href="../../Public/Bootstrap/css/bootstrap.min.css">
			<script type="text/javascript" src="/Public/Bootstrap/js/bootstrap.min.js"></script>
		</head>

		<body>
			<?php require'Public/Header/Header.php'; ?>
			<?php if(!$data['login']['envoi_email'])
				{
			?>
			<div class="form-gap"></div>
				<div class="container mr-5">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="text-center">
										<h3><i class="fa fa-lock fa-4x"></i></i></h3>
										<h2 class="text-center">Mot de passe oublié ?</h2>
										<p>Vous pouvez entrer un mail pour retrouver votre mot de passe.</p>
										<div class="panel-body">
                  
											<form method="POST" action="http://localhost/easy_food/login/password" id="register-form" role="form" autocomplete="off" class="form" method="post">
	                  
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
													<input id="email" name="recup_mail" placeholder="Votre adresse email" class="form-control"  type="email">
												</div>
											</div>

										<div class="form-group">
										<input name="recup_submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
									</div>
                                  
 									<input type="hidden" class="hide" name="token" id="token" value=""> 
                                      </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
				} 

					else if($data['login']['envoi_email'] AND $data['login']['token'] == false)
					{	?>
						<div class="row"><div class="col-md-6 .col-md-offset-3">
						<h4 class="mt-5">Récupération de mot de passe</h4>
						<p>Un code de vérification vous a été envoyé par mail: <?= $data['login']['recup_email']; ?></p>
						<br/></div></div>
			
			<?php  }

						 else { ?>
						 			<?php 
				 						if($data['login']['erreur'])
				 						{ ?>
				 							<span class="erreur">mot de passe différent !</span>
				 							<style type="text/css"> .erreur{color:red;} </style> 
						 		<?php 
						 				}
						 			 
						 		?>
									<?php
										if(!$data['login']['verif_code_confirm'] AND $data['login']['envoi_email'] )
										{ ?>

										<style>.margin_top{margin-top: 20%;}</style>

										<form class="margin_top" method="post" action="http://localhost/easy_food/login/password/<?= $data['login']['token'] ?>">
											
											<div class="container">
												<div class="row">
													<div class="form-group mx-auto">
														<input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/>
													</div>
												</div>
												
												<div class="row">
													<div class="form-group mx-auto">
														<input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/><br/>
													</div>
												</div>
												
												<div class="row">
													<div class="form-group mx-auto">
														<input type="password" placeholder="Confirmation du password" name="change_mdp_confirmation"/><br/>
													</div>
												</div>
														
												<div class="row mx-auto">
													<div class="form-group mx-auto">
														<input class="btn btn-success" type="submit" value="Valider" name="change_submit"/>
													</div>
												</div>
											</div>						
										</form>
									
									<?php }
											else
											{ ?>

												<p class="mdpchange">Mot de passe changé !</p>
												<style type="text/css">.mdpchange{margin-top: 200px;margin-left: 40%;font-size: 30px;}</style>
										<?php }
							} 
						?>
		</body>
</html>
