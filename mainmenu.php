<?php
	session_start();
	if(!isset($_SESSION['loggedin']))
{
	header('Location: index.php');
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
		<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
			
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav mr-auto">
				
					<li class="nav-item active">
						<a class="nav-link" href="mainmenu.php"> Menu główne </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="addincome.php"> Dodaj przychód </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="addexpence.php"> Dodaj wydatek </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="bilans.php?okres=Bieżący+miesiąc"> Sprawdź bilans </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="settings.php"> Ustawienia </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="logout.php"> Wyloguj się </a>
					</li>
					
				</ul>
			
				
					<input type="button" value="Wyloguj się" onclick="window.location.href='logout.php';" />

				
			
			</div>
		</nav>
		<div class="row">
			<div class="col-md-12 mt-4 text-md-center">
				 <h2><?php echo '<p>Witaj '.$_SESSION['username'].'</p>' ?> </h2>
				<p>W celu dodania wpłaty kliknij "Dodaj przychód" w górnym menu bądź na przycisk poniżej.</p>
				<p>Przycisk "Dodaj wydatek" pozwola dodać Twój każdy poniesiony koszt.</p>
				<p>Przycisk "Sprawdź bilans" pozwoli na graficzne i tabelaryczne przedstawienie stanu twoich finansów w danym okresie czasu.</p>
				<p>"Ustawienia" pozwolą w pełni modyfikować zawartość programu, aby w pełni mógł spełnić Twoje oczekiwania.</p>
				
			</div>

		</div>
		<div class="row">
		<nav class="col-sm-12">
			<div class="tile col-sm-2 d-inline-block">
				<a href="addincome.php" class="tilelink text-light"><i class="icon-plus-1"></i><br/>Dodaj przychód</a>
			</div>
			<div class="tile col-sm-2 d-inline-block">
				<a href="addexpence.php" class="tilelink text-light"><i class="icon-minus-1"></i><br/>Dodaj wydatek</a>
			</div>
			<div class="tile col-sm-2 d-inline-block">
				<a href="bilans.php?okres=Bieżący+miesiąc" class="tilelink text-light"><i class="icon-chart-bar"></i><br/>Przeglądaj bilans</a>
			</div>
			<div class="tile col-sm-2 d-inline-block">
				<a href="settings.php" class="tilelink text-light"><i class="icon-tasks"></i><br/>Ustawienia</a>
			</div>
			<div class="tile col-sm-2 d-inline-block">
				<a href="logout.php" class="tilelink text-light"><i class="icon-logout"></i><br/>Wyloguj się</a>
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