

<?php
    include('_db_connect.php');
	$schueler_logged = $_SESSION['email'];
	$von = $_POST['von'];
	$bis = $_POST['bis'];
	$gemacht = $_POST['gemacht'];
	$probleme = $_POST['probleme'];
  $heute = date("Y-m-d");
  $sql = "INSERT INTO protokolle (schueler, gemacht, von, bis, probleme, datum) VALUES('$schueler_logged', '$gemacht', '$von', '$bis', '$probleme', '$heute')";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
	$_SESSION['popup'] = TRUE;
	$_SESSION['link'] = 'hinzufuegen';
    $_SESSION['nachricht'] = 'gespeichert';
    header('Location: _startseite.php#hinzufuegen');
?>
