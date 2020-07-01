<?php 
	require'Model/AdminModel.php';

	class AdminController extends Controller
	{
		private $administrateur;

		public function __construct()
		{
			$this->administrateur = new AdminModel;
		}

		public function TableauDeBord()
		{
			if(isset($_SESSION['admin']))
			{
				$TableauDeBord = $this->administrateur->GetTableauDeBord();
				return $this->Render('View/AdminView.php',array('TableauDeBord'=>$TableauDeBord));
			}

				else
				{
					echo 'Vous n\'êtes pas autorisé à entrer dans l\'espace administrateur';
				}
		}

		public function AjouterProduit()
		{
			$AjouterProduit = $this->administrateur->AjouterProduit();
		}

		public function SupprimerProduit($reference_produit=false)
		{	
			$Supprimer = $this->administrateur->SupprimerProduit($reference_produit);
		}

		public function ModifierProduit()
		{	
			$ModifierProduit = $this->administrateur->ModifierProduit();
		}
	}
?>