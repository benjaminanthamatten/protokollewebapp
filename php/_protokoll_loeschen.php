<?php
    include('_db_connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM protokolle WHERE protokollID='$id'";
    $pdo->exec($sql); 
	$_SESSION['popup'] = TRUE;
	$_SESSION['link'] = 'bearbeiten';
    $_SESSION['nachricht'] = 'gelöscht';
    header('Location: _startseite.php#bearbeiten');
?>