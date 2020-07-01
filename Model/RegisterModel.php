<?php 
	require_once ('Model/Model.php');
	
	class RegisterModel extends Model
	{
		public function GetInscription()
		{ 	
			/* VARIBLE D'EXPRESSIONS REGUILERES */

			$verification_lettre = '%^[a-zA-Z]{3,10}%';
			$verification_mail = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';
			$verification_mdp = '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/';

			$autorisation_input = 0;
			


			if(isset($_POST['envoyer']))
			{
				if(isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['mail']) AND isset($_POST['mdp']) AND isset($_POST['mdp_confirm']))
				{
					$nom = $_POST['nom'];
					$prenom = $_POST['prenom'];
					$mail = $_POST['mail'];
					$mdp = $_POST['mdp'];
					$mdp_confirmation = $_POST['mdp_confirm'];

					$mdp_confirmation_vide = empty($mdp_confirmation);
					
					$format_nom = preg_match($verification_lettre, $nom);
					$format_prenom = preg_match($verification_lettre, $prenom);
					$format_mail = preg_match($verification_mail, $mail);
					$format_mdp = preg_match($verification_mdp, $mdp);

					$mail_existant = FALSE;
					$mdp_existant = FALSE;

					$inscription = FALSE;
					
					$recup_mail = FALSE;
					$recup_mdp = FALSE;



					/* SI L'INPUT N'EST PAS VIDE ET QUE LES FORMATS SONT BONS, INCREMENTE AUTORISATION_INPUT  */


					if(!empty($nom) AND $format_nom)
					{
						$autorisation_input+=1;
					}

					if(!empty($prenom) AND $format_prenom)
					{
						$autorisation_input+=1;
					}

					if(!empty($mail) AND $format_mail)
					{
						$autorisation_input+=1;
					}

					if(!empty($mdp) AND $format_mdp)
					{
						$autorisation_input+=1;
					}

					if(!empty($mdp_confirmation))
					{
						if($mdp_confirmation != $mdp)
						{
							$mdp_confirmation = FALSE;
						}

							else
							{
								$autorisation_input+=1;
							}
					}


					if($autorisation_input == 5)
					{
						$input_existant = 0;
						$bdd = $this->dbConnect();

						$sql = "SELECT * FROM clients";
						$resultat = $bdd->query($sql);

						/* ON RECHERCHE DANS LA BDD SI IL Y A LE MEME MAIL/MOT DE PASSE QUE LES INPUTS, SI OUI ON INCREMENTE INPUT_EXISTANT */

						while($donnees = $resultat->fetch())
						{
							if($donnees['email'] == $mail)
							{
								$input_existant+=1;	
								$mail_existant = TRUE;	
							}	

								if($donnees['mot_de_passe'] == $mdp)
								{
									$input_existant+=1;
									$mdp_existant = TRUE;	
								}		
						}


						/* SI LE MAIL ET LE PASSWORD NE CORRESPOND PAS AVEC CEUX DE LA BDD, LE CLIENT EST INSCRIT (SI INPU_EXISTANT N'EST PAS EGALE A NULL) */

						if($input_existant == 0)
						{
							/* SI TOUT EST BON, ON ENVOIE UN MAIL A L'UTILISATEUR, ET ON HACHE LE PASSWORD, PUIS ON INSERE TOUS LES INPUTS DANS LA BASE DE DONNEES ET ENVOIE UN MAIL A L'UTILISATEUR*/

							$header="MIME-Version: 1.0\r\n";
							$header.='From:"Easy Food.com"<abdessamad.bannouf@laposte.net>'."\n";
							$header.='Content-Type:text/html; charset="utf-8"'."\n";
							$header.='Content-Transfer-Encoding: 8bit';
							$message = '
							<html>
								<head>
									<title>Votre Inscription - Easy Food.com</title>
									<meta charset="utf-8" />
								</head>

								<body>
									<font color="#303030";>
									<div align="center">
										<table width="600px">
											<tr>
												<td>					                     
													<div align="center">Bonjour <b>'.$prenom.'</b>,</div><br/>
													<p>		Voici votre mail : <b>'.$mail.'</b>, et voici votre mot de passe : <b>'.$mdp.'</b><br/>Ne le divulger à personne, votre code doit rester confidentiel !<br/><br/><br/>
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
					        $a = mail('abdessamad.bannouf@laposte.net','Inscription - Easy Food.com',$message,$header);
					        
							$password_hash = password_hash ($mdp,PASSWORD_DEFAULT);
							$mdp = $password_hash;

							$bdd = $this->dbConnect();
							
							$sql = "INSERT INTO clients(nom,prenom,email,mot_de_passe,token) VALUES(:nom,:prenom,:mail,:mdp,:token)";
							$ajouter = $bdd->prepare($sql);

							$ajouter->bindValue(':nom',$nom,PDO::PARAM_STR);
							$ajouter->bindValue(':prenom',$prenom,PDO::PARAM_STR);
							$ajouter->bindValue(':mail',$mail,PDO::PARAM_STR);
							$ajouter->bindValue(':mdp',$mdp,PDO::PARAM_STR);
							$ajouter->bindValue(':token','',PDO::PARAM_STR);

							$ajouter->execute();

							$recup_mail = $mail;
							$recup_mdp = $mdp;
							$inscription = TRUE;
						}
					}

						/* ON STOCK TOUS LES DONNES NECESSAIRE DANS UN TABLEAU QU'ON VA RENVOYER A LA VUE */

						$verifications_inscriptions = array("nom_vide"=>empty($nom),
															"prenom_vide"=>empty($prenom),
															"mail_vide"=>empty($mail),
															"mdp_vide"=>empty($mdp),
															"mdp_confirmation_vide"=>$mdp_confirmation_vide,
															"format_prenom"=>$format_prenom,
															"format_nom"=>$format_nom,
															"format_mail"=>$format_mail,
															"format_mdp"=>$format_mdp,
															"mdp_confirmation"=>$mdp_confirmation,
															"mail_existant"=>$mail_existant,
															"mdp_existant"=>$mdp_existant,
															"inscription"=>$inscription,
															"recup_mail"=>$recup_mail,
															"recup_mdp"=>$recup_mdp
														);
				}
			}
				


				/* INITIALISE LE TABLEAU AVEC DES VALEURS (POUR EVITER DES BUGS D'AFFICHAGE SUR LA VUE) AVANT LA VALIDATION DU FORMULAIRE */

				else
				{
					$verifications_inscriptions = array(
														"nom_vide"=>FALSE,
														"prenom_vide"=>FALSE,
														"mail_vide"=>FALSE,
														"mdp_vide"=>FALSE,
														"mdp_confirmation_vide"=>FALSE,
														"format_prenom"=>" ",
														"format_nom"=>" ",
														"format_mail"=>" ",
														"format_mdp"=>" ",
														"mdp_confirmation"=>TRUE,
														"mail_existant"=>FALSE,
														"mdp_existant"=>FALSE,
														"inscription"=>FALSE,
														"recup_mail"=>" ",
														"recup_mdp"=>" "
													);
				}				
		
			return $verifications_inscriptions;
		}
	}
?>