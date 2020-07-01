<?php 
	require'Model/ShoppingCartModel.php';

	class ShoppingCartController extends Controller
	{
		private $panier;

		public function __construct()
		{
			$this->panier = new ShoppingCartModel;
		}

		public function Panier($idproduit = false, $supprimer = false)
		{
			if($supprimer == false AND $idproduit == true)
			{
				$paniers = $this->panier->AjouterProduit($idproduit);
			}
			
				else if($supprimer == true AND $idproduit == true)
				{ 
					$paniers = $this->panier->SupprimerPanier($idproduit);
				}

					else if($supprimer == false AND $idproduit == false)
					{
						$paniers = $this->panier->VoirPanier();
					}
 
			return $this->Render('View/ShoppingCartView.php',array('paniers'=>$paniers));
		}

		public function IncrementerProduit($url)
		{
			$paniers = $this->panier->IncrementerProduit($url);
		}

		public function DecrementerProduit($url)
		{
			$paniers = $this->panier->DecrementerProduit($url);
		}
	}
?>