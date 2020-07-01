<?php 
	require 'Model/LoginModel.php';

	class LoginController extends Controller
	{
		private $login;

		public function __construct()
		{
			$this->login = new LoginModel;
		}

		public function Login()
		{
			$loginn = $this->login->GetLogin();
			
			return $this->Render('View/LoginView.php',array('loginn'=>$loginn));
		}

		public function MotDePasse($token = false)
		{	
			/* ON STOCKE LE TOKEN DANS UN ATTRIBUT POUR POUVOIR L'EXPLOITER LORS DE LA CONFIRMATION DU CODE ET DU CHANGEMENT DE MDP */

			$login = $this->login->GetPassword($token);
			
			return $this->Render('View/PasswordView.php',array('login'=>$login));
		}

		public function Deconnect()
		{
			$login = $this->login->GetDeconnect();
			header('location:http://localhost/easy_food');
		}
	}
?>