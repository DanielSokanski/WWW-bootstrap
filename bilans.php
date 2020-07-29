<?php
	session_start();
	$id=$_SESSION['id'];
	
	if(isset($_POST['okres']))
	{
		$okres = $_POST['okres'];
		require_once "connect.php";
		$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
		if($polaczenie->connect_errno!=0)
			{
				echo "Error: ".$polaczenie->connect_errno;
			}
		else if (($okres=="Bieżący miesiąc")||($okres=="Poprzedni miesiąc")||($okres=="Bieżący rok"))
		{
			$polaczenie->query("DROP TABLE bilansresults");
			$polaczenie->query("CREATE TABLE bilansresults 
													(id INT(11)NOT NULL AUTO_INCREMENT,
													category VARCHAR(50) NOT NULL,
													value DECIMAL(8,2) NOT NULL,
													type VARCHAR(50) NOT NULL,
													PRIMARY KEY (id))");
			$no_categories=0;
			$kategoria="";
			$suma=0;
			$_SESSION['kategoria']="12";
			$data=date("Y-m");
			$year  = date('Y'); 
			$time = strtotime("now");
			$final = date("Y-m", strtotime("-1 month", $time));
				if($Ile_kategorii = @$polaczenie->query("SELECT * FROM `expenses_category_assigned_to_users".$id."`"))
					{
						$no_categories= $Ile_kategorii->num_rows;
					}
				for($i=1;$i<=$no_categories;$i++)
					{		
						if($okres=="Bieżący miesiąc") 
						{
							$quotationdate = $data;
						}
						else if  ($okres=="Poprzedni miesiąc")	
						{
							$quotationdate = $final;
						}
						else if  ($okres=="Bieżący rok")	
						{
							$quotationdate = $year;
						}

				if ($rezultat = @$polaczenie->query("SELECT * FROM `expenses` WHERE date_of_expense LIKE '".$quotationdate."%' AND user_id=".$id." AND ".$i."=expense_category_assigned_to_user_id"))
				{
					$ile_wynikow = $rezultat->num_rows;
					if($ile_wynikow!=0)
						{
							$suma = 0;
							while($wiersz = $rezultat->fetch_assoc())
								{
									$suma = $suma+$wiersz['amount'];
									$category=$wiersz['expense_category_assigned_to_user_id'];
									if($categoryname = $polaczenie->query("SELECT *FROM `expenses_category_assigned_to_users".$id."` AS excaas,`expenses`  WHERE ".$category."= excaas.id"))
										{
											$wiersz = $categoryname->fetch_assoc();
											$kategoria = $wiersz['name'];
											$categoryname->free_result();
										}
								
									if($_SESSION['kategoria']!=$kategoria)
										{
											$_SESSION['kategoria']=$kategoria;
										}
									$_SESSION['suma']=$suma;
							
								}
							$cat = $_SESSION['kategoria'];
							$sum = $_SESSION['suma'];
							$polaczenie->query("INSERT INTO bilansresults VALUES (NULL,'$cat', '$sum','koszt')");					
						}
					$rezultat->free_result();
				}
					}
				if($Ile_kategorii1 = @$polaczenie->query("SELECT * FROM `incomes_category_assigned_to_users".$id."`"))
					{
						$no_categories1= $Ile_kategorii1->num_rows;
					}
				for($i=1;$i<=$no_categories1;$i++)
					{
							if ($rezultat1 = @$polaczenie->query("SELECT * FROM `incomes` WHERE date_of_income LIKE '".$quotationdate."%' AND user_id=".$id." AND ".$i."=income_category_assigned_to_user_id"))
								{
									$ile_wynikow = $rezultat1->num_rows;
									if($ile_wynikow!=0)
								{
									$suma = 0;
									while($wiersz = $rezultat1->fetch_assoc())
										{
											$suma = $suma+$wiersz['amount'];
											$category=$wiersz['income_category_assigned_to_user_id'];
											if($categoryname1 = $polaczenie->query("SELECT *FROM `incomes_category_assigned_to_users".$id."` AS incaas,`incomes`  WHERE ".$category."= incaas.id"))
												{
													$wiersz1 = $categoryname1->fetch_assoc();
													$kategoria = $wiersz1['name'];
													$categoryname1->free_result();
												}
											if($_SESSION['kategoria']!=$kategoria)
											{
												$_SESSION['kategoria']=$kategoria;
											}
											$_SESSION['suma']=$suma;
										}
									$cat = $_SESSION['kategoria'];
									$sum = $_SESSION['suma'];
									$polaczenie->query("INSERT INTO bilansresults VALUES (NULL,'$cat', '$sum','przychod')");					
								}
							$rezultat1->free_result();
							}
						}					
			$do_wyswietlenia_koszty = $polaczenie->query("SELECT * FROM bilansresults WHERE type='koszt' ORDER BY value DESC");
		    $no_categories1= $do_wyswietlenia_koszty->num_rows;
			if($no_categories1 > 0) 
			{
					$_SESSION['expenserecord']=true;
			}
		    $do_wyswietlenia_przychody = $polaczenie->query("SELECT * FROM bilansresults WHERE type='przychod' ORDER BY value DESC");
		    $no_categories2= $do_wyswietlenia_przychody->num_rows;
			if($no_categories2 > 0) 
			{
					$_SESSION['incomerecord']=true;
			}
			$query = "SELECT `category`,`value`FROM bilansresults GROUP BY `category`";  
			if((	$result = mysqli_query($polaczenie, $query)))
			{
					$_SESSION['pie_chart']=true;
			}								
		}
		else if ($okres=="Niestandardowy")
		{		
		$_SESSION['niestandardowa_data']=true;	
		}
		$polaczenie->close();
	}
	else if(isset($_POST['data_pocz']))
	{
	$data_pocz = $_POST['data_pocz'];
	$data_kon=$_POST['data_kon'];
	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}			
	$polaczenie->query("DROP TABLE bilansresults");
	$polaczenie->query("CREATE TABLE bilansresults 
									(id INT(11)NOT NULL AUTO_INCREMENT,
									category VARCHAR(50) NOT NULL,
									value DECIMAL(8,2) NOT NULL,
									type VARCHAR(50) NOT NULL,
									PRIMARY KEY (id))");

	if($Ile_kategorii = @$polaczenie->query("SELECT * FROM `expenses_category_assigned_to_users".$id."`"))
		{
			$no_categories= $Ile_kategorii->num_rows;
		}
	for($i=1;$i<=$no_categories;$i++)
	{	
		if ($rezultat = @$polaczenie->query("SELECT * FROM `expenses` WHERE date_of_expense BETWEEN  '".$data_pocz."' AND '".$data_kon."' AND user_id=".$id." AND ".$i."=expense_category_assigned_to_user_id"))
			{
			$ile_rekordow=0;							$ile_wynikow = $rezultat->num_rows;
			if($ile_wynikow!=0)
				{
					$suma = 0;
					while($wiersz = $rezultat->fetch_assoc())
						{
							$suma = $suma+$wiersz['amount'];
							$category=$wiersz['expense_category_assigned_to_user_id'];
								if($categoryname = $polaczenie->query("SELECT *FROM `expenses_category_assigned_to_users".$id."` AS excaas,`expenses`  WHERE ".$category."= excaas.id"))
									{
										$wiersz = $categoryname->fetch_assoc();
										$kategoria = $wiersz['name'];
										$categoryname->free_result();
									}
								if($_SESSION['kategoria']!=$kategoria)
									{
										$_SESSION['kategoria']=$kategoria;
									}
								$_SESSION['suma']=$suma;

						}
							$cat = $_SESSION['kategoria'];
							$sum = $_SESSION['suma'];
							$polaczenie->query("INSERT INTO bilansresults VALUES (NULL,'$cat', '$sum','koszt')");					
				}
					$rezultat->free_result();
			}
	}
	if($Ile_kategorii1 = @$polaczenie->query("SELECT * FROM `incomes_category_assigned_to_users".$id."`"))
		{
			$no_categories1= $Ile_kategorii1->num_rows;
		}
	for($i=1;$i<=$no_categories1;$i++)
	{	
		if ($rezultat1 = @$polaczenie->query("SELECT * FROM `incomes` WHERE date_of_income BETWEEN  '".$data_pocz."' AND '".$data_kon."' AND user_id=".$id." AND ".$i."=income_category_assigned_to_user_id"))
		{
		$ile_wynikow1 = $rezultat1->num_rows;
			if($ile_wynikow1!=0)
				{
					$suma = 0;
						while($wiersz = $rezultat1->fetch_assoc())
							{
								$suma = $suma+$wiersz['amount'];
								$category=$wiersz['income_category_assigned_to_user_id'];
								if($categoryname1 = $polaczenie->query("SELECT *FROM `incomes_category_assigned_to_users".$id."` AS incaas,`incomes`  WHERE ".$category."= incaas.id"))
									{
										$wiersz1 = $categoryname1->fetch_assoc();
										$kategoria = $wiersz1['name'];
										$categoryname1->free_result();
									}
								if($_SESSION['kategoria']!=$kategoria)
									{
										$_SESSION['kategoria']=$kategoria;
									}
								$_SESSION['suma']=$suma;

							}
					$cat = $_SESSION['kategoria'];
					$sum = $_SESSION['suma'];
					$polaczenie->query("INSERT INTO bilansresults VALUES (NULL,'$cat', '$sum','przychod')");				
				}
			$rezultat1->free_result();
		}
	}				
			
	$do_wyswietlenia_koszty = $polaczenie->query("SELECT * FROM bilansresults WHERE type='koszt' ORDER BY value DESC");
	$no_categories1= $do_wyswietlenia_koszty->num_rows;
	if($no_categories1 > 0) 
		{
			$_SESSION['expenserecord']=true;
		}
	$do_wyswietlenia_przychody = $polaczenie->query("SELECT * FROM bilansresults WHERE type='przychod' ORDER BY value DESC");
	$no_categories2= $do_wyswietlenia_przychody->num_rows;
		if($no_categories2 > 0) 
		{
			$_SESSION['incomerecord']=true;
		}
		$query = "SELECT `category`,`value`FROM bilansresults GROUP BY `category`";  
		if((	$result = mysqli_query($polaczenie, $query)))
		{
			$_SESSION['pie_chart']=true;
		}								
		$polaczenie->close();
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
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() 
	  {

        var data = google.visualization.arrayToDataTable([
          ['category', 'value'],
		<?php
		$no_categories3= $result->num_rows;
		$i=0;
		while($row = mysqli_fetch_array($result))
		{		
			if ($i<$no_categories3-1)
			{
				echo "['".$row["category"]."',".$row["value"]."],";
				$i++;	
				}
			else 
			{
				echo "['".$row["category"]."',	".$row["value"]."]";
			}
		}
		?>
        ]);
        var options = {
          title: 'Wydatki i przychody we wskazanym okresie czasu',
		  is3D: true,
        };
		var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
	  }
		</script>
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
					<li class="nav-item">
						<a class="nav-link" href="addincome.php"> Dodaj przychód </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="addexpence.php"> Dodaj wydatek </a>
					</li>
					<li class="nav-item active">
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
			<div class="col-sm-12 col-md-12 mt-4 text-dark text-center">
				<h2> Bilans</h2>
				<p>Sprawdź czy w danym okresie czasu udało Ci się zaoszczędzić.</p>
			</div>
		</div>
		<div class="row">
		<div class="col-sm-12 col-md-12 mt-4 text-center text-dark">
			<label> Z jakiego zakresu czasowego chcesz zobaczyć swój bilans? </label>
			<p>Wybierz z poniższej listy</p>
			<div style="margin-top:10px;">
			<form method="post">
				<select id="okres" name="okres">
					<option value="Bieżący miesiąc" name="Bieżący miesiąc" selected>Bieżący miesiąc</option>
					<option value="Poprzedni miesiąc" name="Poprzedni miesiąc">Poprzedni miesiąc</option>
					<option value="Bieżący rok" name="Bieżący rok">Bieżący rok</option>
					<option value="Niestandardowy" name="Niestandardowy">Niestandardowy</option>
				</select>
			</div>
			<br><input type="submit" value="Wybierz">
		</div>
			</form>
		<?php 
		if (isset($_SESSION['niestandardowa_data']))
		{
			echo '<div class="col-sm-12 col-md-12 mt-4 text-center text-dark"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#niestandard">Wprowadź daty</button></div>';
		}
		unset($_SESSION['niestandardowa_data']);
		?>
		  <div class="modal" id="niestandard" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
					<form id="myform" method="post" action="">
						<label>Data początkowa<input class="ml-4" type="date" name="data_pocz"  required></label>
						<label>Data końcowa<input class="ml-4" type="date" name="data_kon" required></label>
					</div>
					<div class="modal-footer">
						<input type="submit" value="Zapisz daty" class="btn btn-success btn-lg marginTop" />
					</div>
					</form >
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-md-6 mt-4 text-center bg-success text-light">
			<h3 class="text-center">  Przychody </h3>
				   <div class="border col-sm-5 col-md-5 mt-1 text-center bg-success text-light d-inline-block">Kategoria</div> <div class="border col-sm-5 col-md-5 mt-1 text-center bg-success text-light d-inline-block">Kwota [zł]</div>
		<?php
		if (isset($_SESSION['incomerecord']))
		{
			$incomesum=0;
			while($e = $do_wyswietlenia_przychody->fetch_assoc()) 
				{
					echo '
					<div class="border col-sm-5 col-md-5 mt-1 text-center bg-success text-light d-inline-block">'.$e['category'].'</div>
					<div class="border col-sm-5 col-md-5 mt-1 text-center bg-success text-light d-inline-block">'.$e['value'].'</div>';
					$incomesum=$incomesum +$e['value'];
				}
				$_SESSION['incomesum']=$incomesum;
				$_SESSION['opis']=true;
		}		
		unset($_SESSION['incomerecord']);
		?>
		</div>
		<div class="col-sm-6 col-md-6 mt-4 text-center bg-warning text-dark">
			<h3 class="text-center">  Koszty </h3>
				   <div class="border col-sm-5 col-md-5 mt-1 text-center bg-warning text-dark d-inline-block" >Kategoria</div> <div class="border col-sm-5 col-md-5 mt-1 text-center bg-warning text-dark d-inline-block">Kwota [zł]</div> 
		<?php
			if (isset($_SESSION['expenserecord']))
			{
				$expensesum=0;
				//echo var_dump($rekordy);
				while($r = $do_wyswietlenia_koszty->fetch_assoc()) 
				{
						echo '<br />
						<div class="border col-sm-5 col-md-5 mt-1 text-center bg-warning text-dark d-inline-block">'.$r['category'].'</div>
						<div class="border col-sm-5 col-md-5 mt-1 text-center bg-warning text-dark d-inline-block">'.$r['value'].'</div>';
						$expensesum=$expensesum +$r['value'];
				}
				$_SESSION['expensesum']=$expensesum;
			}		
			unset($_SESSION['expenserecord']);
		?>	
		</div>
		</div>
		<?php
		if (isset($_SESSION['opis']))
		{
		$wynik = 0;
				if (!isset($_SESSION['incomesum']))
				{
					$_SESSION['incomesum']=0;
				}
				else if (!isset($_SESSION['expensesum']))
				{
					$_SESSION['expensesum']=0;
				}
		$wynik = $_SESSION['incomesum']-$_SESSION['expensesum'];
		echo '<div class="border col-sm-6 col-md-6 mt-1 text-center bg-success text-light d-inline-block font-weight-bold">
		Łączna kwota przychodów: '.$_SESSION['incomesum'].' zł
		</div><div class="border col-sm-6 col-md-6 mt-1 text-center bg-warning text-dark d-inline-block font-weight-bold">
		Łączna kwota wydatków: '.$_SESSION['expensesum'].' zł
		</div>';
			if($wynik>0)
			{
				echo '<div class="row">';
				echo '<div class="col-sm-12 col-md-12 mt-4 text-dark text-center border bg-white font-weight-bold">
				<h4 >Gratulacje. Świetnie zarządzasz finansami!</h4>
				<h4 >Bilans: '.$wynik.' zł</h4></div>';
				echo '</div">';
			}
			if($wynik<0)
			{
				
				echo '<div class="row">';
				echo '<div class="col-sm-12 col-md-12 mt-4 text-danger text-center border bg-white font-weight-bold">
				<h4 >Uważaj, wpadasz w długi!</h4>
				<h4 >Bilans: '.$wynik.' zł</h4></div>';
				echo '</div">';
			}
		}
		unset ($_SESSION['opis']);
		unset ($_SESSION['expensesum']);
		?>
				<div class="col-sm-12 col-md-12 bg-white">
		<?php
			if (isset($_SESSION['pie_chart']))
			{
			echo '<div id="piechart_3d" style="width:100%;height:400px;margin-left:auto;margin-right:auto;"></div>';

			}
			
			unset ($_SESSION['pie_chart']);
		?>
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