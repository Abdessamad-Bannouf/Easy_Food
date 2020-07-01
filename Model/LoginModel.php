<?php 
	require_once ('Model/Model.php');
	
	class LoginModel extends Model
	{
		public function GetLogin() 
		{	
			$bdd = $this->dbConnect();

			$sql = "SELECT * FROM clients";			
			$resultat = $bdd->query($sql); 

			$erreur = false;

			if(isset($_POST['email']) AND isset($_POST['pass']))
			{	
				while($donnees = $resultat->fetch())
				{
					/* SI LE MAIL ET LE MOT DE PASSE EXISTE DANS LA BASE DE DONNEES, ON ENREGISTRE LE NOM DE L'UTILISATEUR*/
					if($_POST['email'] == $donnees['email'] AND password_verify($_POST['pass'], $donnees['mot_de_passe']))
					{
						$_SESSION['prenom'] = $donnees['prenom'];

						/* SI LE MOT DE PASS ET L'EMAIL CORRESPOND, ON REDIRIGE VERS LA PAGE ADMIN*/

						if($donnees['isAdmin'] == 1)
						{
							header('location:http://localhost/easy_food/administrateur');
							$_SESSION['admin'] = true;
							return ($_SESSION['prenom']);
						}

							else
							{
								header('location:http://localhost/easy_food');
							}
					}

						else
						{
							$erreur = true;
						}
				}
			}

			return array(	
							'erreur'=>$erreur
						);

		}



		public function GetPassword($token = false)
		{
			$bdd = $this->dbConnect();

			$envoi_email = FALSE;

			/* VERIFIE SI LE MAIL A BIEN ETE ENTRE ET SI IL N'EST PAS VIDE */

			if(isset($_POST['recup_submit'],$_POST['recup_mail']) AND !empty($_POST['recup_mail']))
			{
				$envoi_email = FALSE;
				$email = $_POST['recup_mail']; 

				/* VERIFIE SI LE MAIL EXISTE */

				$sql_email_exist = "SELECT prenom,email FROM clients WHERE email=?";

				$mail_exist = $bdd->prepare($sql_email_exist);
				$mail_exist->execute(array($email));
				$mail_exist_count = $mail_exist->rowCount();

				/* SI IL EXISTE, ON STOCK UN TOKEN DE LA TABLE CLIENTS GRACE A LA FONCTION MD5 ET ON ENVOIE UN MAIL A L'UTILISATEUR AVEC LE PRENOM TROUVE DANS LA BDD */

				if($mail_exist_count)
				{
					$prenom = $mail_exist->fetch();
					$prenom = $prenom['prenom'];

					$token = md5(uniqid(mt_rand(),true));

					$sql_insert_token = "UPDATE clients SET token=? WHERE email=?";

					$insert_token = $bdd->prepare($sql_insert_token);
					$insert_token->execute(array($token,$email));

					/* ON ENVOIE ENSUITE UN MAIL A L'UTILISATEUR AVEC UN LIEN CLIQUABLE CONTENANT LE TOKEN */

					$header="MIME-Version: 1.0\r\n";
					$header.='From:"Easy Food.com"<abdessamad.bannouf@laposte.net>'."\n";
					$header.='Content-Type:text/html; charset="utf-8"'."\n";
					$header.='Content-Transfer-Encoding: 8bit';
					$message = '
					<html>
						<head>
							<title>Récupération de mot de passe - Easy Food.com</title>
							<meta charset="utf-8" />
						</head>

						<body>
							<font color="#303030";>
							<div align="center">
								<table width="600px">
									<tr>
										<td>					                     
											<div align="center">Bonjour <b>'.$prenom.'</b>,</div><br/>
											<p>		Voici le lien pour changer votre mot de passe : <b>'.'<a href="http://localhost/easy_food/login/password/'.$token.'"</b> récupérer votre mot de passe</a><br/><br/><br/>
											A bientôt sur <a href="http://localhost/easy_food">Easy_Food.com!</a>  
											</p>
										</td>
									</tr>

									<tr>
										<td align="center">
											<font size="2">
												Ceci est un email automatique, merci de ne pas y répondre
											</font>
					                   </td>
									</tr>
								</table>
							</div>
							</font>
						</body>
					</html>
			         ';

					$envoi_email = mail($email, "Inscription - Easy Food.com", $message, $header);
				}

				/* ON RETOURNE UN TABLEAU ASSOCIATIF AVEC DIFF2RENTS PARAMETRES POUR AFFICHER UN FORM QUI CONTIENT L'INPUT MAIL */
				
				return array(
								'recup_email'=>$email,
								'envoi_email'=>true,
								'token'=>false,
								'verif_code_confirm'=>false,
								'erreur'=>false
							);	
			}

				else if($token AND !isset($_POST['change_mdp']))
				{
					/* ON RETOURNE UN TABLEAU ASSOCIATIF AVEC DIFF2RENTS PARAMETRES POUR AFFICHER UN FORM QUI CONTIENT LES INPUTS MAILS, MDP, ET CONFIRM MDP POUR LE NOUVEAU MDP */
					return array(
									'modif_pass'=>true,
									'envoi_email'=>true,
									'token'=>$token,
									'verif_code_confirm'=>false,
									'erreur'=>false
								);
				}


					/* SI TOUT EST OK, ON VA CHERCHER DANS LA BASE DE DONNEE L'UTILISATEUR A L'AIDE DU TOKEN, ET ON VA LUI CHANGER LE MOT DE PASSE */

					if(isset($_POST['change_mdp']) AND isset($_POST['change_mdp_confirmation']) AND isset($_POST['recup_mail']) AND isset($_POST['change_submit']))
					{	
						$change_mdp = $_POST['change_mdp'];

						$change_mdp_confirmation = $_POST['change_mdp_confirmation'];

						/* SI LE MOT DE PASSE EST IDENTIQUE AU MOT DE PASSE CONFIRMATION */

						if($change_mdp == $change_mdp_confirmation)
						{

							/* VERIF POUR SAVOIR SI LE TOKEN QUI EST DANS LA BDD EST LE MEME QUE CELUI QUI EST SUR L'URL */

							$sql_verif_token = "SELECT token FROM clients WHERE token=?";

							$verif_token = $bdd->prepare($sql_verif_token);
							$verif_token->execute(array($token));

							$count_verif_token = $verif_token->rowCount();

							/* SI OUI, ON CHANGE LE MOT DE PASSE */

							if($count_verif_token)
							{
								$prenom = $verif_token->fetch();
								$change_mdpp = password_hash($change_mdp,PASSWORD_DEFAULT);

								$sql_new_password = "UPDATE clients SET mot_de_passe = ? WHERE token=?";

								$new_password = $bdd->prepare($sql_new_password);
								$new_password->execute(array($change_mdpp,$token));

								return array
											(
												'verif_code_confirm'=>true,
												'envoi_email'=>true,
												'token'=>$token,
												'erreur'=>false
											);
							}
						}	

							else
							{
								return array(
												'envoi_email'=>true,
												'token'=>true,
												'erreur'=>true,
												'verif_code_confirm'=>false
											);
							}
					}					
		}



		public function GetDeconnect()
		{
			if(isset($_SESSION['prenom']))
			{
				session_destroy();

				header('location:http://localhost/easy_food');
			}
		}
	}
?>