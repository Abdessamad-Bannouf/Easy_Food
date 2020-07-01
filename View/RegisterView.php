<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="Public/Register-Package/css/style.css"/>
		
		<link rel="stylesheet" href="Public/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="Public/Bootstrap/js/bootstrap.min.js">
		<title>Inscription</title>
	</head>

	<body>
		<?php require'Public/Header/Header.php'; ?>

		<?php if(!$data['sinscrire']['inscription']){?>

		<form action="http://localhost/easy_food/inscription" method="POST">
	      
	        <h1>S'inscrire</h1>
	        
			<fieldset>
				<legend><span class="number">I</span>Votre profil</legend>



				<!-- NOM DE L'UTILISATEUR !-->

				<label for="nom">Nom:</label>
					<?php 
						if($data['sinscrire']['nom_vide'])
						{?>
								<style type="text/css">.nom{border: 1px red solid;}</style>

								<p class="champ_vide">Le champ est vide !</p>
					<?php }

							else
							{?>
								<style type="text/css">.nom{border: none;}</style>

								<?php 
									if(!$data['sinscrire']['format_nom'])
									{?>
										<style type="text/css">.nom{border: 1px red solid;}</style>
										<p class="champ_format">Ce n'est pas le bon format !</p>
								<?php
									}?> 
					 <?php }

					?>
				<input class="nom" type="text" id="nom" name="nom">



				<!-- PRENOM DE L'UTILISATEUR! -->

				<label for="prenom">Prenom:</label>
					<?php
						if($data['sinscrire']['prenom_vide'])
						{?>
							<style type="text/css">.prenom{border: 1px red solid;}</style>

							<p class="champ_vide">Le champ est vide !</p>

					<?php }

							else
							{?>
								<style type="text/css">.prenom{border: none;}</style>

								<?php 
									if(!$data['sinscrire']['format_prenom'])
									{?>
										<style type="text/css">.prenom{border: 1px red solid;}</style>
										<p class="champ_format">Ce n'est pas le bon format !</p>
								<?php
									}?> 
					 <?php }

					?>
				<input class="prenom" type="text" id="prenom" name="prenom">



				<!-- MAIL DE L'UTILISATEUR! -->

				<label for="mail">Email:</label>
				<?php 
					if($data['sinscrire']['mail_vide'])
					{?>
						<style type="text/css">.mail{border: 1px red solid;}</style>

						<p class="champ_vide">Le champ est vide !</p>

				<?php }

						else
							{?>
								<style type="text/css">.mail{border: none;}</style>

								<?php 
									if(!$data['sinscrire']['format_mail'])
									{?>
										<style type="text/css">.mail{border: 1px red solid;}</style>
										
										<p class="champ_format">Ce n'est pas le bon format !</p>

								<?php } 

									else{
											if($data['sinscrire']["mail_existant"])
											{?>
													<p class="input-exist">Ce mail existe déjà</p>	
										<?php }
										}
					  		}?>

				<input class="mail" type="email" id="mail" name="mail">



				<!-- MOT DE PASSE DE L'UTILISATEUR! -->

				<label for="password">Mot de passe:</label>
				<?php
					if($data['sinscrire']['mdp_vide'])
					{?>
						<style type="text/css">.password{border: 1px red solid;}</style>

						<p class="champ_vide">Le champ est vide !</p>

			 <?php }

						else
							{?>
								<style type="text/css">.password{border: none;}</style>

								<?php 
									if(!$data['sinscrire']['format_mdp'])
									{?>
										<style type="text/css">.password{border: 1px red solid;}</style>

										<p class="champ_format">Ce n'est pas le bon format !</p>

								<?php }

									else{
											if($data['sinscrire']["mdp_existant"])
											{?>
													<p class="input-exist">Ce mot de passe existe déjà</p>	
										<?php }
										}
					  		}?>
					
				<input class="password" type="password" id="password" name="mdp">



				<!-- CONFIRMATION DU MOT DE PASSE! -->

				<label for="passwordconfirm">Confirmer le mot de passe:</label>
				<?php
					if($data['sinscrire']['mdp_confirmation_vide'])
						{?>
							<style type="text/css">.password-confirm{border: 1px red solid;}</style>

							<span class="champ_vide">Le champ est vide !</span>

				 <?php }

						else
							{?>
								<style type="text/css">.password-confirm{border: none;}</style>

								<?php 
									if(!$data['sinscrire']['mdp_confirmation'])
									{?>
										<style type="text/css">.password-confirm{border: 1px red solid;}</style>
										<p class="champ_format">Le mot de passe n'est pas identique !</p>
								<?php
									}
							}?>

				<input class="password-confirm" type="password" id="passwordconfirm" name="mdp_confirm">             
			</fieldset>

			<button class="bouton" type="submit" name="envoyer">M'inscrire !</button>
		</form>
		<?php 
			}
	
				else
				{?>
					<h1 class="text-center">Bienvenue parmi nous !</h1>

					<p class="text-center">Un mail vient de vous être envoyé avec vos identifiants(mail) et mot de passe ! *interdit de divulger ces informations ! </p>

			<?php 
	
				} 
			?>
	</body>
</html>