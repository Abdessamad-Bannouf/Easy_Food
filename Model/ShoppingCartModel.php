<?php 
	require_once ('Model/Model.php');

	class ShoppingCartModel extends Model
	{
		public function CreationPanier()
		{
			/* SI LE PANIER N'EXISTE PAS, ON LE CREER SOUS FORME D'ARRAY(CAR IL PEUT CONTENIR PLUSIEURS ARTICLES */

			if (!isset($_SESSION['panier']))
			{
				$_SESSION['panier'] = array();
		 		$_SESSION['panier']['id'] = array();
				$_SESSION['panier']['designation'] = array();
		 		$_SESSION['panier']['prix'] = array();
		 		$_SESSION['panier']['image'] = array();
				$_SESSION['panier']['quantite'] = array();
				$_SESSION['panier']['description'] = array();
			}

			/* RETOURNE TRUE SI LE PANIER EST CREE */
	    	return true;
		}

		public function AjouterProduit($idproduits)
		{	 
			$bdd = $this->dbConnect();

			/* ON RECHERCHE DANS LA BASE DE DONNEES LA REF, DESI, PRIX DE l'IDPRODUIT*/

			$sql = "SELECT * FROM produits WHERE id = '$idproduits'";
			$test = $bdd->query($sql);

			while($donnees = $test->fetch())
			{
				$id = $donnees['id'];
				$designation = $donnees['designation'];
				$prix = $donnees['prix'];
				$image = $donnees['image'];
				$description = $donnees['description'];
			}

			$qte = 1;

			if ($this->CreationPanier())
			{	
				/* RECHERCHE SI IL Y A A PAS UN PRODUIT DU MEME TYPE QUI A DEJA ETE ENREGISTRE */
		    	$positionProduit = array_search($idproduits,$_SESSION['panier']['id']);

		    	/* SI POSITIONPRODUIT EST DIFFERENT DE FAUX, CA INCREMENTE LE PRODUIT DE 1*/
				if ($positionProduit !== false)
				{	
					if(isset($_SESSION['panier']['quantite']))
					{
			    		$_SESSION['panier']['quantite'][$positionProduit] += $qte;
			    		var_dump($_SESSION['panier']['quantite']);
					}
				}

					/* SINON ON RAJOUTE LE PRODUIT */
				    else
				    {
				        array_push($_SESSION['panier']['id'],$id);
				        array_push($_SESSION['panier']['designation'],$designation);
				        array_push($_SESSION['panier']['prix'],$prix);
				        array_push($_SESSION['panier']['image'],$image);
				        array_push($_SESSION['panier']['quantite'],$qte);
				        array_push($_SESSION['panier']['description'],$description);
				    }
			}

			$ref = $_SESSION['panier']['id'];
			$des = $_SESSION['panier']['designation'];
			$prix = $_SESSION['panier']['prix'];
			$image = $_SESSION['panier']['image'];
			$quantite = $_SESSION['panier']['quantite'];
			$description = $_SESSION['panier']['description'];

   			header('location:http://localhost/easy_food/panier');
   			return array(
   							'id'=>$ref,
   							'designation'=>$des,
   							'prix'=>$prix,
   							'image'=>$image,
   							'quantite'=>$quantite,
   							'description'=>$description
   						);
		}



		public function SupprimerPanier($idproduits)
		{
			if($this->CreationPanier())
			{
				/* ON CREER UN PANIER TEMPORAIRE */
				$tmp=array();
				$tmp['id'] = array();
				$tmp['designation'] = array();
				$tmp['prix'] = array();
				$tmp['image'] = array();
				$tmp['quantite'] = array();
				$tmp['description'] = array();

				for($i=0; $i<count($_SESSION['panier']['id']); $i++)
	  			{
	  				/* SI L'IDPRODUITS EST DIFFERENT DE LA REFERENCE DU PRODUIT, ON LE RAJOUTE DANS LE PANIER TEMPORAIRE */
					if ($_SESSION['panier']['id'][$i] !== $idproduits)
					{
						array_push($tmp['id'],$_SESSION['panier']['id'][$i]);
						array_push($tmp['designation'],$_SESSION['panier']['designation'][$i]);
						array_push($tmp['prix'],$_SESSION['panier']['prix'][$i]);
						array_push($tmp['image'],$_SESSION['panier']['image'][$i]);
						array_push($tmp['quantite'],$_SESSION['panier']['quantite'][$i]);
						array_push($tmp['description'],$_SESSION['panier']['description'][$i]);
					}
				}

				/* DANS LE PANIER ON MET LE PANIER TEMPORAIRE QUI CONTIENT TOUS LES PRODUITS HORMIS CELUI QUE LE CLIENT VEUT SUPPRIMER */
				$_SESSION['panier'] = $tmp;
				
				/* ON DETRUIT LE PRODUIT RESTANT */
				unset($tmp);
			}

			header('location:http://localhost/easy_food/panier');
		}



		public function VoirPanier()
		{
			if($this->CreationPanier())
			{
				$ref = $_SESSION['panier']['id'];
				$des = $_SESSION['panier']['designation'];
				$prix = $_SESSION['panier']['prix'];
				$image = $_SESSION['panier']['image'];
				$quantite = $_SESSION['panier']['quantite'];
				$description = $_SESSION['panier']['description'];
			}

			return array($ref,$des,$prix,$image,$quantite,$description);
		}



		public function IncrementerProduit($idproduits)
		{
			$incremente=1;

			if($this->CreationPanier())
			{
				for($i=0;$i<count($_SESSION['panier']['id']);$i++)
				{
					if($_SESSION['panier']['id'][$i] === $idproduits)
					{	
						$_SESSION['panier']['id'][$i] += $incremente;
					}					
				}
			}

			header('location:http://localhost/easy_food/panier');
		}



		public function DecrementerProduit($idproduits)
		{
			$decremente=1;
			
			if($this->CreationPanier())
			{
				for($i=0;$i<count($_SESSION['panier']['id']);$i++)
				{
					if($_SESSION['panier']['id'][$i] === $idproduits)
					{	
						$_SESSION['panier']['quantite'][$i] -= $decremente;

						if($_SESSION['panier']['quantite'][$i] == 0)
						{
							$this->SupprimerPanier($idproduits);
						}
					}					
				}
			}

			header('location:http://localhost/easy_food/panier');
		}
	}
?>