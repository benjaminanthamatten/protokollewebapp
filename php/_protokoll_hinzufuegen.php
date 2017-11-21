<div id="hinzufuegen">
	<form action="#" method="post">
		Von: <input name="von" type="time"></input><br>
		Bis: <input name="bis" type="time"></input><br>
		Was habe ich gemacht: <input name="gemacht" type="text"></input><br>
		Probleme: <input name="probleme" type="text"></input>
		<br><input type="submit" name="send" value="Absenden">
	</form>
</div>

<?php
	session_start();
	$schueler = $_SESSION['email'];
	
	if(isset($_POST["send"]))
	{
	$von = $_POST['von'];
	$bis = $_POST['bis'];
	$gemacht = $_POST['gemacht'];
	$probleme = $_POST['probleme'];
	$sql = "INSERT INTO protokolle (schueler, gemacht, von, bis, probleme) VALUES('$schueler', '$gemacht', '$von', '$bis', '$probleme')";
	$sql_speichern = mysqli_query($verbindung, $sql);
	}
?>