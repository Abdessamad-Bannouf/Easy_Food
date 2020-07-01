<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ma commande</title>

		<!------ INCLURE LES LIENS/LIBRAIRIES POUR LE TEMPLATE PANIER !---------->

		<link rel="stylesheet" type="text/css" href="Public/Bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="Public/Bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="Public/Shopping-Package/css/font-awesome.min.css">
		<link rel="stylesheet" href="../Public/Font-Awesome/css/font-awesome.min.css">
	</head>


	<body>
		<?php require'Public/Header/Header.php'; ?>


		<!-- SI LE PANIER N'EST PAS VIDE AFFICHE LES TITRES PDT,PRIX,QUANTITE,TOTAL!-->

		<?php if(!empty($data['paniers'][0][0])){ ?>
		<div class="container">
			<table id="cart" class="table table-hover table-condensed">
				<thead>
					<tr>
						<th style="width:50%">Produit</th>
						<th style="width:10%">Prix</th>
						<th style="width:8%">Quantité</th>
						<th style="width:22%" class="text-center">Total</th>
						<th style="width:10%"></th>
					</tr>
				</thead>

				<tbody>



					<!-- BOUCLE POUR AFFICHER CHAQUE PRODUIT DU PANIER!-->

					<!--
						[0][$i] = reference
					  	[1][$i] = designation
					  	[2]{$i] = prix
					  	[3][$i] = image
					  	[4][$i] = quantite
					  	[5][$i] = description
					!-->
					<?php $totall = 0;?>
					<?php for($i=0;$i<count($data['paniers'][0]);$i++){?>
					<tr>
						<td data-th="Product">
							<div class="row">
								<div class="col-sm-2 hidden-xs"><?php echo'<img class="img-fluid" src="Public/Images/'.$data['paniers'][3][$i].'" alt="..." />' ?></div>
								
								<div class="col-sm-10">
									<h4 class="ml-5">reference : <?= $data['paniers'][0][$i].' '.$data['paniers'][1][$i] ?> </h4>
									<p class="ml-5"><?= $data['paniers'][5][$i]?>.</p>
								</div>
							</div>
						</td>

						<td data-th="Price"><?= $data['paniers'][2][$i].' €' ?></td>

						<td data-th="Quantity">
							<div class="d-inline">
								<a href=<?php echo"http://localhost/easy_food/panier/incrementer/".$data['paniers'][0][$i].""?>><button><i class="fa fa-angle-up"></i></button></a>
							</div>

							<div class="d-inline">
								<?php echo '<input type="text" class="form-control text-center" name="" value="'.$data['paniers'][4][$i].'">'; ?>
							</div>

							<div class="d-inline">
								<a href=<?php echo"http://localhost/easy_food/panier/decrementer/".$data['paniers'][0][$i].""?>><button><i class="fa fa-angle-down"></i></button></a>
							</div>
						</td>

						<td data-th="Subtotal" class="text-center"><?= $total = $data['paniers'][2][$i] * $data['paniers'][4][$i]; $totall +=$total;  ?></td>
						<td class="actions" data-th="">
							<?php echo '<a href="http://localhost/easy_food/panier/supprimer/'.$data['paniers'][0][$i].'"><button class="btn btn-danger btn-lg"><i class="fa fa-trash-o"></i></button></a>';?>								
						</td>
					</tr>
				</tbody>


				<!-- LORSQU'ON ARRIVE AU DERNIER PASSAGE DE LA BOUCLE, ON DEMANDE D'AFFICHER LES BOUTONS CONTINUER MES ACHATS, PASSER AU PAIEMENT !-->

				<?php if($i == count($data['paniers'][0])-1){?>
				<tfoot>
					<tr class="visible-xs">
						<td class="text-center"><strong><?= $totall.' €' ?></strong></td>
					</tr>
					<tr>
						<td><a href="http://localhost/easy_food" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuer mes achats</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td class="hidden-xs text-center"><strong><?= $totall.' €' ?></strong></td>
						<td><a href="#" class="btn btn-success btn-block">Paiement <i class="fa fa-angle-right"></i></a></td>
					</tr>
				</tfoot>
			</table>

		<?php
			 }}}
			 	 else
			 	 	{?>
			 	 		<p class="paniervide">Votre panier est vide ! <br><br><td><a href="http://localhost/easy_food" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuer mes achats</a></td>
			 	 			<style type="text/css">.paniervide{margin-top:200px;margin-left: 10%;font-size: 2em;}/style>
			 	 	<?php } ?> 
	</body>
</html>