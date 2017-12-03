<?php
setcookie('datum', $_POST['datum'], time()+(3600*24));
setcookie('schueler', $_POST['schueler'], time()+(3600*24));
setcookie('klasse', $_POST['klasse'], time()+(3600*24));
setcookie('gemacht', $_POST['gemacht'], time()+(3600*24));
setcookie('filter', 'aktiv', time()+(3600*24));
/*
setcookie('datum', $datum, time()-3600);
setcookie('schueler', $schueler, time()-3600);
setcookie('klasse', $klasse, time()-3600);
setcookie('gemacht', $gemacht, time()-3600);
setcookie('filter', 'aktiv', time()-3600);
*/

session_start();
$_SESSION['popup'] = TRUE;
$_SESSION['link'] = 'uebersicht';
$_SESSION['nachricht'] = 'gefiltert';
header('Location: _startseite.php#uebersicht');
?>
