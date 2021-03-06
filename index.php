<?php
session_start();

if ((isset($_SESSION['loggedin']))&&($_SESSION['loggedin']==true))
{
	header('Location: mainmenu.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Domowy Budżet</title>
	<meta name="description" content="Aplikacja do zarządzania domowym budżetem">
	<meta name="keywords" content="budżet, wydatek, przychód, bilans">
	<meta name="author" content="Daniel Sokanski">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/fontello.css" type="text/css"/>
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
	
	<header>
		<div class="logo">
			<h1> BUDŻET DOMOWY </h1>
			<p> Kompleksowo zarządzaj swoim budżetem domowym </p>
		</div>
	</header>
	<div class="container">
	<main>
		
		<div class="row">
		
			<div class="col-sm-12 mt-4 text-danger font-weight-bold">
				<p>Jak często zdarzało Ci się przeszacowywać swoje wydatki?</p>
				<p>Czy planując większy wydatek zachodziłeś w głowę jak to zaplanować? </p>
				<p>Jak często traciłeś orientacje w sprawach domowych finansów? </p>
			</div>
			<div class="col-sm-12 mt-4">
				<span class="boldtext">ROZWIĄZENIE JEST W ZASIĘGU TWOJEJ RĘKI</span>
			</div>
			<div class="col-sm-12 mt-4 text-dark font-weight-bold">
				<p>Proste, intuicyjne narzędzie do codziennego użytku, </p><p> które pozwoli Ci na bieżącą kontrolę przychodów i wydatków. </p>
				<p>Proces dodania kolejnej wpłaty lub wypłaty jest możliwy </p><p> nawet stojąc w kolejce w sklepie czy na stacji benzynowej. </p>
				<p>Program posiada zadeklarowene odgórnie metody płatności,</p><p>jednakże jeżeli masz ochote możesz dodawać, usuwać i edytować pola.</p>
			</div>
			<div class="col-sm-12 mt-4 text-dark mb-2">
				<span class="boldtext">NIE ZASTANAWIAJ SIĘ DŁUŻEJ I OD DZIŚ W PEŁNI KONTROLUJ SWÓJ PORTFEL</span>
			</div>
	
		</div>
		<div class="row">
		<nav class="newuser">
			<div class="col-sm-4" id="index-login">
				
				<label class="text-dark text-uppercase text-md-center font-weight-bold"> Masz konto? </label> <br> <input class="bg-dark text-light " type="button" value="Zaloguj się" onclick="window.location.href='login.php'" />
					 
			</div>
			<div class="col-sm-4" id="index-register">
				<label  class="text-dark text-uppercase text-md-center font-weight-bold"> Jeszcze nie korzystasz? </label> <br> <input class="bg-dark text-light" type="button" value="Zarejestruj się" onclick="window.location.href='login.php'" />
			</div>
		</nav>
		</div>
	</main>
	</div>
	<footer>
		
		<div class="mt-5">&copy; Wszelkie prawa zastrzeżone. Autor: Daniel Sokański  </div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
</body>
</html>