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
				
					<li class="nav-item">
						<a class="nav-link" href="mainmenu.html"> Menu główne </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="addincome.html"> Dodaj przychód </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="addexpence.html"> Dodaj wydatek </a>
					</li>
					
					<li class="nav-item active">
						<a class="nav-link" href="bilans.html"> Sprawdź bilans </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="settings.html"> Ustawienia </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="logout.html"> Wyloguj się </a>
					</li>
					
				</ul>
			
				<form class="form-inline">
					<input type="button" value="Zaloguj się" onclick="window.location.href='login.html'" />
					<input type="button" value="Zarejestruj się" onclick="window.location.href='login.html'" />

				</form>
			
			</div>
		</nav>
		<div class="row">
		
			<div class="col-sm-12 col-md-12 mt-4 text-center">
				<h2> Bilans</h2>
				<p>Sprawdź czy w danym okresie czasu udało Ci się zaoszczędzić.</p>
			</div>
	
		</div>
		<div class="row">
		
		<div class="col-sm-12 col-md-12 mt-4 text-center">
			<label> Z jakiego zakresu czasowego chcesz zobaczyć swój bilans? </label>
			<p>Wybierz z poniższej listy</p>
			<div style="margin-top:10px;">
				<select id="okres" name="okres[]">
					<option value="bm" selected>Bieżący miesiąc</option>
					<option value="pm" >Poprzedni miesiąc</option>
					<option value="br"> Bieżący rok</option>
					<option value="ns">Niestandardowy</option>
				</select>
				
			</div>
			<br><input type="submit" value="Wybierz">
		</div>
		
		<div class="col-sm-3 col-md-6 mt-4 text-center bg-success text-light">
			<h3 class="text-center">  Przychody </h3>
				  <div class="incometable">Kategoria</div> <div class="incometable">Kwota [zł]</div> <div class="incometable">Opis</div>
					
				<div class="incometable">Wynagrodzenie</div> <div class="incometable">4 500,00</div> <div class="incometable">Wypłata 06.2020</div>	
	
		</div>
		
		<div class="col-sm-3 col-md-6 mt-4 text-center bg-warning text-dark">
			<h3 class="text-center">  Koszty </h3>
				  <div class="expencetable">Kategoria</div> <div class="expencetable">Kwota [zł]</div> <div class="expencetable">Opis</div>
					
				<div class="expencetable">Mieszkanie</div> <div class="expencetable">850,00</div> <div class="expencetable">Czynsz za 06.2020</div>	
	
		</div>
				
			


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