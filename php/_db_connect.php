<?php
session_start();

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
