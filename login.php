<?php
	session_start();
	
	if(isset($_POST['name']))
	{
		$wszystkook = true;
		
		$name=$_POST['name'];
		if ((strlen($name)<3)||(strlen($name)>20))
		{
			$wszystkook=false;
			$_SESSION['e_name']="Nick musi posiadać od 3 do 20 znaków!";
		}
		
		$haslo1 = $_POST['haslo1'];
		if((strlen($haslo1)<3)||(strlen($haslo1)>20))
		{
			$wszystkook=false;
			$_SESSION['e_haslo1']="Haslo musi posiadać od 8 do 20 znaków!";
		}
		
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystkook=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		$_SESSION['fr_name'] = $name;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;


		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystkook=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		


				if ($wszystkook==true)
				{
					
					
					if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$name', '$haslo_hash', '$email')"))
					{
						$_SESSION['udanarejestracja']=true;
						$_SESSION['e_success']="Dziękujemy za rejestrację! Teraz możesz się zalogować na swoje konto.";
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
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
		
		<div class="row">
		<article>
			<div class="col-sm-6 col-md-4 mt-4 pb-2" id="login">
			<form action="zaloguj.php" method="post">
					<h2> Zaloguj się </h2>
					<p></p>
					<p><label> Imie </label> <input type="text" name="name1"></p>
					<p><label> Hasło </label> <input type="password" name="haslo2" id="haslo"></p>
					<input type="submit" value="Zaloguj się">
			</form>	
				<?php
				if (isset($_SESSION['blad'])) echo $_SESSION['blad'];
				?>
			</div>
			
			<div class="col-sm-6 col-md-4 mt-4 pb-2" id="register">
			<form method="post">
					<h2> Zarejestruj się </h2>
					<p></p>
					<p><label> Imię  </label> <input type="text" <?php
						if (isset($_SESSION['fr_name']))
						{
							echo $_SESSION['fr_name'];
							unset($_SESSION['fr_name']);
						} ?> name="name"></p>
					<?php
							if (isset($_SESSION['e_name']))
							{
								echo '<div class="error">'.$_SESSION['e_name'].'</div>';
								unset($_SESSION['e_name']);
							}
						?>
					<p><label> E-mail </label> <input type="text" 
					<?php
						if (isset($_SESSION['fr_email']))
						{
							echo $_SESSION['fr_email'];
							unset($_SESSION['fr_email']);
						}
					?>name="email"></p>
						<?php
							if (isset($_SESSION['e_email']))
							{
								echo '<div class="error">'.$_SESSION['e_email'].'</div>';
								unset($_SESSION['e_email']);
							}
						?>
					<p><label> Hasło </label> <input type="password" <?php
					if (isset($_SESSION['fr_haslo1']))
						{
							echo $_SESSION['fr_haslo1'];
							unset($_SESSION['fr_haslo1']);
						}?>name="haslo1"></p>
					<?php
							if (isset($_SESSION['e_haslo1']))
							{
								echo '<div class="error">'.$_SESSION['e_haslo1'].'</div>';
								unset($_SESSION['e_haslo1']);
							}
						?>
					
					<input type="submit" value="Zapisz"> 
					<input type="reset" value="Wyczyść dane"> 
					<?php
							if (isset($_SESSION['e_success']))
							{
								echo '<div class="error">'.$_SESSION['e_success'].'</div>';
								unset($_SESSION['e_success']);
							}
						?>
			</form>
			</div>
	
		</article>
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