<!DOCTYPE html>
<html>
	<head>
		<title>Tableau de bord</title>

		<!-- BIBLIOTHEQUE JQUERY!-->

		<link rel="stylesheet" type="text/css" href="Public/Bootstrap/css/bootstrap.min.css">
		<script src="Public/JS/Jquery/Jquery.js" type="text/JavaScript"></script>
	</head>

	<body>
		<?php require'Public/Header/Header.php'; ?>

		<h1>Vous trouverez divers options liés aux produits .</h1>
		<hr/>

		<button id="boutonAjout" type="button" class="btn btn-primary btn-lg">Ajouter article</button>
		<button id="boutonModification" type="button" class="btn btn-primary btn-lg">Modifier article</button>

		<?php foreach($data['TableauDeBord'] as $tdb): ?>
			<p><?= $tdb['id'] ?>
				<?= $tdb['designation'] ?>
			<button class="btn btn-danger">		
				<?= $tdb['prix'].'<a href="http://localhost/easy_food/administrateur/supprimer/'.$tdb['id'].'">supprimer</a><br/>' ?>
			</button>
			</p>
		<?php endforeach; ?>

		<div id="contenuAjout">
			
		</div>

		<div id="contenuModif">
			
		</div>

		 
		<script>
			$(document).ready(function(){
				$("#boutonAjout").click(function(){
				    $.ajax({
				       url : 'Public/JS/Add-Product-Form/Add.php',
				       type : 'GET',
				       dataType : 'html',

				       success : function(reponse,statut){ 
				    	$("#contenuAjout").html(reponse);
				    	$("#contenuAjout").show();
				    	$("#contenuModif").hide();
				       }
					});
				});

				$("#boutonModification").click(function(){
				    $.ajax({
				       url : 'Public/JS/Update-Product-Form/Update.php',
				       type : 'GET',
				       dataType : 'html',

				       success : function(reponse,statut){ 
				    	$("#contenuModif").html(reponse);
				    	$("#contenuModif").show();
				    	$("#contenuAjout").hide();
				       }
					});
				});
			});
		</script>
	</body>



