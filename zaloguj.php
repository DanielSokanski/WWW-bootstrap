<?php

	session_start();
	
if ((!isset($_POST['name1'])) || (!isset($_POST['haslo2'])))
			{
				header('Location: index.php');
				exit();
			}
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user,$db_password, $db_name);
	
	if($polaczenie->connect_errno!=0)
			{
				echo "Error: ".$polaczenie->connect_errno;
			}
	else
			{
				$name1 = $_POST['name1'];
				$haslo2 = $_POST['haslo2'];
				
				$name1 = htmlentities($name1, ENT_QUOTES, "UTF-8");
				
				
				
				if ($rezultat = @$polaczenie->query(
				sprintf("SELECT * FROM users WHERE username='%s'",
				mysqli_real_escape_string($polaczenie,$name1))))
				{
					$ilu_userow = $rezultat->num_rows;
					
					if($ilu_userow>0)
							{
								$wiersz = $rezultat->fetch_assoc();
								
								
								if (password_verify($haslo2, $wiersz['password']))
										{
											$_SESSION['loggedin'] = true;
											$_SESSION['id'] = $wiersz['id'];
											$_SESSION['username'] = $wiersz['username'];
											$_SESSION['email'] = $wiersz['email'];
											
											
											unset($_SESSION['blad']);
											$rezultat->free_result();
											$polaczenie->query("CREATE TABLE incomes_category_assigned_to_users".$_SESSION['id']." 
											(id INT(11)NOT NULL AUTO_INCREMENT,
											user_id INT(11) NOT NULL,
											name VARCHAR(50) NOT NULL,
											PRIMARY KEY (id))
											SELECT name FROM incomes_category_default");
											$polaczenie->query("UPDATE incomes_category_assigned_to_users".$_SESSION['id']." SET user_id=".$_SESSION['id']." WHERE user_id = 0");
											$polaczenie->query("CREATE TABLE expenses_category_assigned_to_users".$_SESSION['id']." 
											(id INT(11)NOT NULL AUTO_INCREMENT,
											user_id INT(11) NOT NULL,
											name VARCHAR(50) NOT NULL,
											PRIMARY KEY (id))
											SELECT name FROM expenses_category_default");
											$polaczenie->query("UPDATE expenses_category_assigned_to_users".$_SESSION['id']." SET user_id=".$_SESSION['id']." WHERE user_id = 0");
											$polaczenie->query("CREATE TABLE payment_methods_assigned_to_users".$_SESSION['id']." 
											(id INT(11)NOT NULL AUTO_INCREMENT,
											user_id INT(11) NOT NULL,
											name VARCHAR(50) NOT NULL,
											PRIMARY KEY (id))
											SELECT name FROM payment_methods_default");
											$polaczenie->query("UPDATE payment_methods_assigned_to_users".$_SESSION['id']." SET user_id=".$_SESSION['id']." WHERE user_id = 0");
											
											header('Location: mainmenu.php');
										}
								else 
								{
									$_SESSION['blad'] = '<span style="color:red">1111Nieprawidłowy login lub hasło!</span>';
									header('Location: index.php');
								}
							} 
							else {
								
								$_SESSION['blad'] = '<span style="color:red">2222Nieprawidłowy login lub haslo!</span>';
								header('Location: index.php');
								
							}
						}
				$polaczenie->close();
			}	

?>