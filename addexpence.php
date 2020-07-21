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
					
					<li class="nav-item active">
						<a class="nav-link" href="addexpence.html"> Dodaj wydatek </a>
					</li>
					
					<li class="nav-item">
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
		
			<div class="col-sm-6 col-md-12 mt-4 text-center">
				<h2>Dodaj wydatek</h2>
				<p>Wypełnij poniższy formularz punkt po punkcie i zatwierdź by wprowadzić dane do programu.</p>
			</div>
			
		</div>
		<div class="row">
		
				<div class="numbers col-sm-2 col-md-3 text-md-right mt-3 font-weight-bold" id="numbers">
					<p>1.</p>
				</div>
				
				<div class="col-sm-2 col-md-3 text-center mt-3 font-weight-bold" id="value">
					<label> Podaj kwotę  </label>
				</div>
				
				<div class="col-sm-3 col-md-6 text-md-left mt-3" id="evalue">
					<input class="ml-4" type="text" name="kwota">
				</div>
				
				<div class="numbers col-sm-2 col-md-3 text-md-right mt-3 font-weight-bold">
					<p>2.</p>
				</div>
				
				<div class="col-sm-2 col-md-3 text-center mt-3 font-weight-bold" id="date">
					<label> Data  </label> 
				</div>
	
				<div class="col-sm-3 col-md-6 text-md-left mt-3" id="edate">
					<input class="ml-4" type="date" name="data">
				</div>
				
				<div class="numbers col-sm-2 col-md-3 text-md-right mt-3 font-weight-bold">
					<p>3.</p>
				</div>
				
				<div class="col-sm-2 col-md-3 text-center mt-3 font-weight-bold" id="payment">
						<label> Sposób płatności</label>
				</div>
				
				<div class="col-sm-3 col-md-6 text-md-left mt-3" id="epayment">
					<fieldset>	
						<div><label><input type="radio" value="got" name="got" checked> Gotówka </label></div>
						<div><label><input type="radio" value="kd" name="kd"> Karta debetowa </label></div>
						<div><label><input type="radio" value="kk" name="kk"> Karta kredytowa </label></div>
					</fieldset>
				</div>
				
				<div class="numbers col-sm-2 col-md-3 text-md-right mt-3 font-weight-bold">
					<p>4.</p>
				</div>
				
				<div class="col-sm-2 col-md-3 text-center mt-3 font-weight-bold" id="category">
					<label> Kategoria </label>

				</div>	
				
				<div class="col-sm-3 col-md-6 text-md-left mt-3" id="ecategory">
						<select id="kategoria" name="kategoria[]">
							<option value="j" selected>Jedzenie</option>
							<option value="m" >Mieszkanie</option>
							<option value="t">Transport</option>
							<option value="te">Telekomunikacja</option>
							<option value="oz">Opieka zdrowotna</option>
							<option value="u">Ubranie</option>
							<option value="h">Higiena</option>
							<option value="dz">Dzieci</option>
							<option value="r">Rozrywka</option>
							<option value="s">Szkolenia</option>
							<option value="k">Książki</option>
							<option value="o">Oszczędności</option>
							<option value="e">Na złotą jesień, czyli emeryturę</option>
							<option value="sd">Spłata długów</option>
							<option value="d">Darowizna</option>
							<option value="iw">Inne wydatki</option>
						</select>
				</div>
				
					<div class="col-sm-6 col-md-12 text-md-center mt-3" id="comment">
						<div><label for="komentarz"> Komentarz </label></div>
						<textarea name="komentarz" id="komentarz" rows="3" cols="30" ></textarea>
					</div>
					<div class="col-sm-6 col-md-12 text-md-center mt-3">
							<input class="mr-2 bg-success" type="submit" value="Dodaj">
							<input class="mr-2 bg-danger" type="submit" value="Anuluj">
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