<?php 
	require'ProductController.php';
	require'LoginController.php';
	require'AdminController.php';
	require'ShoppingCartController.php';
	require'RegisterController.php';

	class Controller
	{
		private $ProductController;
		private $LoginController;
		private $AdminController;
		private $ShoppingCartController;
		private $RegisterController;

		public function __construct()
		{
			$this->ProductController = new ProductController;
			$this->LoginController = new LoginController;
			$this->AdminController = new AdminController;
			$this->ShoppingCartController = new ShoppingCartController;
			$this->RegisterController = new RegisterController;
		}

		public function SearchController()
		{
			if(isset($_GET['url']))
			{
				$url = $_GET['url'];
				$url = rtrim($url,'/');
				$url = explode('/',$url);

				/************** PRODUITS **************/

				/************** CATEGORIE PRODUITS **********/
				if($url[0] == 'produits' AND !empty($url[1]))
				{
					$this->ProductController->produits($url[1]);
				}

					else if($url[0] == 'produits' AND empty($url[1]))
					{
						$this->ProductController->produits();
					}

					

				/************** LOGIN **************/

				if($url[0] == 'login' AND empty($url[1]))
				{
					$this->LoginController->Login();
				}

					else if($url[0] == 'login' AND $url[1] == 'deconnexion')
					{
						$this->LoginController->Deconnect();
					}

						else if($url[0] == 'login' AND $url[1] == 'password' OR !empty($url[2]))
						{
							if(!empty($url[2]))
							{
								$this->LoginController->MotDePasse($url[2]);
							}

								else
								{
									$this->LoginController->MotDePasse();
								}
						}



				/************** INSCRIPTION **************/

				if($url[0] == 'inscription')
				{
					$this->RegisterController->inscription();
				}



				/************** ADMINISTRATEUR **************/

				if($url[0] == 'administrateur' AND empty($url[1]))
				{
					$this->AdminController->TableauDeBord();
				}

					else if($url[0] == 'administrateur' AND $url[1] == 'ajouter')
					{
						$this->AdminController->AjouterProduit();
					}

						else if ($url[0] == 'administrateur' AND $url[1] == 'supprimer' AND is_numeric($url[2]))
						{
							$this->AdminController->SupprimerProduit($url[2]);
						}

							else if ($url[0] == 'administrateur' AND $url[1] == 'modifier')
							{	
								$this->AdminController->ModifierProduit();
							}



				/************** PANIER **************/

				if($url[0] == 'panier' AND empty($url[1]) AND empty($url[2]))
				{
					$this->ShoppingCartController->Panier();
				}

					else if($url[0] == 'panier' AND is_numeric($url[1]))
					{
						$this->ShoppingCartController->Panier($url[1]);
					}

						else if($url[0] == 'panier' AND $url[1] == 'supprimer' AND is_numeric($url[2]))
						{
							$this->ShoppingCartController->Panier($url[2],$url[1]);
						}

							else if($url[0] == 'panier' AND $url[1] == 'incrementer' AND  is_numeric($url[2]))
							{
								$this->ShoppingCartController->IncrementerProduit($url[2]);
							}

								else if($url[0] == 'panier' AND $url[1] == 'decrementer' AND is_numeric($url[2]))
								{
									$this->ShoppingCartController->DecrementerProduit($url[2]);
								}
	 
			}



			/************** SI IL N' Y A RIEN DANS L'URL, AFFICHE LES PRODUITS(PAR DEFAUT) **************/

			if(empty($url[0]))
			{
				$this->ProductController->produits();
			}
		}

		public function Render($file, $data = array())
		{
			require $file;
		}
	}
?>