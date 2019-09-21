<?php
ob_start();
session_start();
require_once '../dbcon.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}


if(isset($_POST['adminconnexion']))
{
    $adminpseudo = htmlspecialchars($_POST['pseudo']);
	$adminmdp = sha1($_POST['mdp']);
	if(!empty($adminpseudo) AND !empty($adminmdp))
	{
		$adminconnect = $bdd->prepare("SELECT * FROM lesadmins WHERE admin_pseudo = ? AND admin_mdp = ?");
		$adminconnect->execute(array($adminpseudo, $adminmdp));
		$adminexist = $adminconnect->rowCount();
		if($adminexist == 1)
		{
			
			$admininfo = $adminconnect->fetch();
			$_SESSION['admin_id'] = $admininfo['id_admin'];
			header("Location: index.php");
		}
		else
		{
			echo  "Mauvais mail ou mot de passe !";
		}
	}
	else
	{
		echo "Tous les champs doivent être complétés !";
	}
};



?>
<!doctype html>
<!--[if IE 9]> <html class="no-js ie9 fixed-layout" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js " lang="fr"> <!--<![endif]-->
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Meta -->
    <title>Tic-Tac Carte Grise</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">

	<!-- Google Fonts -->
 	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,700" rel="stylesheet">

	<!-- Custom & Default Styles -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" href="../css/carousel.css">
	<link rel="stylesheet" href="../style.css">

	<!--[if lt IE 9]>
		<script src="js/vendor/html5shiv.min.js"></script>
		<script src="js/vendor/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	
	<section class="section lb">
			<div class="container">
				<div class="section-title text-center">
					<h3>Connexion Administrateur</h3>
					<hr>
					<p class="lead">Pour vous connecter remplissez les champs si dessous.</p>
				</div><!-- end section-title -->

				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<form class="quoteform lightform" method="POST">
		                   	<input type="text" name="pseudo" class="form-control" placeholder="Pseudo">
		                   	<input type="password" name="mdp" class="form-control" placeholder="Mot de passe">
                            <button type="submit" name="adminconnexion" class="btn btn-transparent btn-block">Se connecter</button><br/>
						

						</form>
					</div><!-- end col -->
				</div><!-- end row -->
			</div><!-- end container -->
		</section><!-- end section -->
	
	<!-- jQuery Files -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/parallax.js"></script>
	<script src="../js/animate.js"></script>
	<script src="../js/owl.carousel.js"></script>
	<script src="../js/custom.js"></script>
</body>
<html>