<?php 
	require'Model/RegisterModel.php';
	
	class RegisterController extends Controller
	{
		public function __construct()
		{
			$this->inscription = new RegisterModel;
		}

		public function inscription()
		{
			$sinscrire = $this->inscription->GetInscription();
			return $this->Render('View/RegisterView.php',array('sinscrire'=>$sinscrire));
		}
	}
?>