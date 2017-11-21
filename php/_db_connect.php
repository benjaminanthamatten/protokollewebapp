<?php
session_start();

  $server = "localhost"; //Server hier eingeben
  $user= "root"; //Benutzername hier eingeben
  $pass = ""; //Passwort des Server-Benutzers eingeben
  $database = "protokollewebapp"; //Datenbanknamen eingeben

  $verbindung = mysqli_connect($server, $user, $pass, $database)
                or die("Verbindung konnte nicht hergestellt werden.");
				
	$pdo = new PDO('mysql:host=localhost;dbname=protokollewebapp', 'root', '');
	
	
?> 