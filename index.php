<?php
	require 'Controller/Controller.php';
	
	/* Demarre la session (pour le panier et pour l'utilisateur) */
	session_start();

	/* Si le loggin existe, c'est qu'on a réussit à se connecter, on stocke le nom et le prenom du client dans la variable $_SESSION['nom']  */ 
	if(isset($loginn))
	{
		$_SESSION['nom'] = $loginn;
		require'View/Header/Header.php';
	}

	/* On instancie un objet Routeur et on l'appelle */

	$r = new Controller;
	$r->SearchController();
 ?>
