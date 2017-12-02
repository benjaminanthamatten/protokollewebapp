<?php
    include('_db_connect.php');
    $id = $_GET['id'];

    if(isset($_POST['abbrechen'])){
        $_SESSION['bearbeiten'] = FALSE;
        $_SESSION['bearbeiten_id'] = FALSE;
        header('Location: _startseite.php#bearbeiten');
    } else {

    if(isset($_POST['speichern'])){
        
    echo $gemacht = $_POST['gemacht'];
    echo $von = $_POST['von'];
    echo $bis = $_POST['bis'];
    echo $probleme = $_POST['probleme']; 
        

    $sql = "UPDATE protokolle SET gemacht='$gemacht', von='$von', bis='$bis', probleme='$probleme' WHERE protokollID = '$id'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $_SESSION['bearbeiten'] = FALSE;
    $_SESSION['bearbeiten_id'] = FALSE;    
	$_SESSION['popup'] = TRUE;
	$_SESSION['link'] = 'bearbeiten';
    $_SESSION['nachricht'] = 'geändert';        
    header('Location: _startseite.php#bearbeiten');   
        
    } else {
        
    $_SESSION['bearbeiten'] = TRUE;
    $_SESSION['bearbeiten_id'] = $id;
    header('Location: _startseite.php#bearbeiten');
        
    }}
?>