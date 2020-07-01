<?php 
	require_once ('Model/Model.php');

	class ProductModel extends Model
	{
		public function GetProduits()
		{		
			$bdd = $this->dbConnect();
			$sql = "SELECT * FROM produits";
			$resultat = $bdd->query($sql);

			return $resultat;
		}	

		public function GetCategorie($categorie)
		{
			$bdd = $this->dbConnect();
			//$Model = new Model;

			$sql = "SELECT id FROM categorie WHERE nom='$categorie'";
			$LaCategorie = $bdd->query($sql);

			while($donnees=$LaCategorie->fetch())
			{
				$CategorieId = $donnees['id'];
			}

			$sql2 = "SELECT * FROM produits AS p JOIN categorie AS c ON p.id_categorie=c.id WHERE p.id_categorie=$CategorieId";
			$resultat = $bdd->query($sql2);

			$sql3 = "SELECT nom FROM categorie";
			$toutes_les_categories = $bdd->prepare($sql3);


			/* ON RECHERCHE DANS LA BDD LE NUMERO ID DE LA CATEGORIE SE TROUVANT DANS L'URL */

		/*	$test2 = $Model->SelectFilter('id','categorie','nom',$categorie);
			$a = $Model->Fetch('id',$test2);*/

			/* ON AFFICHE LES PRODUITS EN RELATION AVEC LES CATEGORIES */

			/*$test3 = $Model->Join('produits','p','categorie','c','id_categorie','id',$a);

			$resultat = $bdd->query($test3);*/

			return $resultat;
		}	
	}
?>