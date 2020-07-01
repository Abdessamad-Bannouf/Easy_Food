<?php 
	require_once ('Model/Model.php');
	
	class AdminModel extends Model
	{
		public function GetTableauDeBord()
		{
			$bdd = $this->dbConnect();

			$sql = "SELECT * FROM produits";
			$resultat = $bdd->query($sql);

			return $resultat;
		}

		public function AjouterProduit()
		{
			//$bdd = $this->dbConnect();

			$Connexion = new Model;

			if(isset($_POST['envoyer']))
			{	
				$reference = $_POST['reference'];
				$designation = $_POST['designation'];
				$prix = $_POST['prix'];
				$image = $_FILES['image']['name'];
				$description = $_POST['description'];
				$categorie = $_POST['categorie'];

				$SQLInsert = $Connexion->RequestInsert('produits', array(
																			'reference',
																			'designation',
																			'prix',
																			'image',
																			'description',
																			'id_categorie'),
																	array(
																			$reference,
																			$designation,
																			$prix,
																			$image,
																			$description,
																			$categorie
																	)
														);

				$Connexion->RequestExecute($SQLInsert); 
				
				/*$sql = "INSERT INTO produits(reference,designation,prix,image,description,id_categorie) VALUES(:reference,:designation,:prix,:image,:description,:categorie)";

				$ajouter = $bdd->prepare($sql);
				$ajouter->bindValue(':reference',$reference,PDO::PARAM_INT);
				$ajouter->bindValue(':designation',$designation,PDO::PARAM_STR);
				$ajouter->bindValue(':prix',$prix,PDO::PARAM_STR);
				$ajouter->bindValue(':image',$image,PDO::PARAM_STR);
				$ajouter->bindValue(':description',$description,PDO::PARAM_STR);
				$ajouter->bindValue(':categorie',$categorie,PDO::PARAM_STR);
				$ajouter->execute(); */
				
				header('location:http://localhost/easy_food/administrateur');
			}
		}

		public function SupprimerProduit($reference_produit)
		{	
			//$bdd = $this->dbConnect();

			$Connexion = new Model;

			$SQLDelete = $Connexion->RequestDelete('produits','reference',$reference_produit); 
			$Connexion->RequestExecute($SQLDelete); 

			//$bdd = $this->dbConnect();
			/*$sql = "DELETE FROM produits WHERE reference=:reference";

			$supprimer = $bdd->prepare($sql);
			$supprimer->bindValue(':reference',$reference_produit,PDO::PARAM_STR);
			$supprimer->execute();*/

			header('location:http://localhost/easy_food/administrateur');
		}

		public function ModifierProduit()
		{
			//$bdd = $this->dbConnect();
			$Connexion = new Model;


			if(isset($_POST['envoyer']))
			{	
				$reference = $_POST['reference'];
				$designation = $_POST['designation'];
				$prix = $_POST['prix'];
				$image = $_FILES['image']['name'];
				$description = $_POST['description'];
				$categorie = $_POST['categorie'];

				$SQLModify = $Connexion->RequestModify('produits',array(
																		'reference',
																		'designation',
																		'prix',
																		'image',
																		'description',
																		'id_categorie'
																		),7,
																array(
																		$reference,
																		$designation,
																		$prix,
																		$image,
																		$description,
																		$categorie
																	)
													);

				$Connexion->RequestExecute($SQLModify);

				/*
				$sql = "UPDATE produits SET designation = :designation, prix = :prix, image = :image, description = :description, id_categorie = :categorie WHERE reference = :reference";

				$modifier = $bdd->prepare($sql);
				
				$a = $modifier->execute(array('reference'=>$reference,'designation'=>$designation,'prix'=>$prix,'image'=>$image,'description'=>$description,'categorie'=>$categorie)); 
				*/
				
				/*$sql2 = "SELECT id FROM categorie WHERE nom='$categorie'";
				$test = $bdd->query($sql2);
				$test2 = $test->rowCount();

				if($test2)
				{
					$test2 = $test->fetch();
					echo $test2['id'];
				}*/

				header('location:http://localhost/easy_food/administrateur');
			}
		}
	}
?>