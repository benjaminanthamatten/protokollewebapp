<?php
setcookie('filter', 'aktiv', time()-3600);
session_start();
$_SESSION['popup'] = TRUE;
$_SESSION['link'] = 'uebersicht';
$_SESSION['nachricht'] = 'Filter zurückgesetzt';
header('Location: _startseite.php#uebersicht');
?>
