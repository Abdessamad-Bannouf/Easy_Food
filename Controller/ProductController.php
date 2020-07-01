<?php 
	require'Model/ProductModel.php';

	class ProductController extends Controller
	{
		private $produit;

		public function __construct()
		{
			$this->produit = new ProductModel;
		}

		public function produits($categorie = false)
		{
			if($categorie == false)
			{
				$produits = $this->produit->GetProduits();
			}

				else
				{	
					$produits = $this->produit->GetCategorie($categorie);
				}

			return $this->Render('View/ProductView.php',array('produits'=>$produits));

		}
	}
?>