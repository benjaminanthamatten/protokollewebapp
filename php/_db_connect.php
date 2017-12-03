<?php
session_start();

  $server = "localhost"; //Server hier eingeben
  $user= "root"; //Benutzername hier eingeben
  $pass = ""; //Passwort des Server-Benutzers eingeben
  $database = "protokollewebapp"; //Datenbanknamen eingeben

  $verbindung = mysqli_connect($server, $user, $pass, $database)
                or die("Verbindung konnte nicht hergestellt werden.");
				
	$pdo = new PDO('mysql:host=localhost;dbname=protokollewebapp', 'root', '');
 
/* Email des angemeldetn Schüler ausgeben */
if(isset($_SESSION['email'])){
$email = $_SESSION['email'];

/* schuelerID des angemeldetn Schüler ausgeben */
$sql_schuelerid = "SELECT schuelerID FROM schueler WHERE email = '$email'";
foreach ($pdo->query($sql_schuelerid) as $schuelerid) {
	$schuelerID = $schuelerid['schuelerID'];
}}
?> 