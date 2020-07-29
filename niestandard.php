<?php

	session_start();
	if ((!isset($_POST['data_pocz'])) || (!isset($_POST['data_kon'])))
	{
		echo $_POST['data_pocz'];
		echo $_POST['data_kon'];
		
		
		
	}
	
	
?>