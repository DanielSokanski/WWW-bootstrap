<?php
	session_start();
	$id=$_SESSION['id'];
	if(isset($_POST['kwota']))
	{
	$kwota = $_POST['kwota'];
	$data = $_POST['data'];
	$kategoria = $_POST['kategoria'];
	$komentarz = $_POST['komentarz'];

	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno!=0)
			{
				echo "Error: ".$polaczenie->connect_errno;
			}
	else
			{	
				if ($rezultat = @$polaczenie->query(
				sprintf("SELECT * FROM `incomes_category_assigned_to_users".$id."` WHERE name='%s'",
				mysqli_real_escape_string($polaczenie,$kategoria))))
				{
					$ile_wynikow = $rezultat->num_rows;
					if($ile_wynikow>0)
							{
								$wiersz = $rezultat->fetch_assoc();
								$cat_id = $wiersz['id'];
								$polaczenie->query("INSERT INTO incomes VALUES (NULL, '$id' , '$cat_id','$kwota', '$data', '$komentarz')");
								$rezultat->free_result();
							}
				$polaczenie->close();
				}
			}
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
				
					<li class="nav-item">
						<a class="nav-link" href="mainmenu.php"> Menu główne </a>
					</li>
					
					<li class="nav-item active">
						<a class="nav-link" href="addincome.php"> Dodaj przychód </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="addexpence.php"> Dodaj wydatek </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="bilans.php"> Sprawdź bilans </a>
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

			<div class="col-sm-6 col-md-12 mt-4 text-dark font-weight-bold text-center">
				<h2>Dodaj przychód</h2>
				<p>Wypełnij poniższy formularz i zatwierdź by wprowadzić dane do programu.</p>
			</div>

		</div>
		<div class="row">
				
		
				<div class="col-sm-6 col-md-6 text-dark text-right mt-3 font-weight-bold" >
					<p> Podaj kwotę  </p>
					<p> Data  </p>
					<p> Kategoria </p>
					<p> Komentarz </p>
				</div>
				
				<div class="col-sm-6 col-md-6 text-md-left mt-3">
					<form method="post">
						<p><input class="ml-4" type="text" name="kwota"></p>
						<p><input class="ml-4" type="date" name="data"></p>
						<p><select id="kategoria" name="kategoria">
							<option value="Wynagrodzenie" name="Wynagrodzenie" selected>Wynagrodzenie</option>
							<option value="Odsetki bankowe"  name="Odsetki bankowe"  >Odsetki bankowe</option>
							<option value="Sprzedaż na allegro"  name="Sprzedaż na allegro" >Sprzedaż na allegro</option>
							<option value="Inne"  name="Inne" >Inne</option>
						</select></p>
						<textarea name="komentarz" id="komentarz" rows="3" cols="30" ></textarea></p>
						<input class="mr-2 bg-success" type="submit" value="Dodaj">
						
					</form>
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