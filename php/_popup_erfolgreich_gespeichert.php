<?php 
if(isset($_GET['popupSchliessen'])){
	$_SESSION['popup'] = FALSE;
	$link = $_SESSION['link'];
	header("Location: _startseite.php#$link");
}

	if(isset($_SESSION['popup']))
	{ if($_SESSION['popup'] == TRUE){
?>
<style>
	#popup_hintergrund {
		background-color: rgba(0,0,0,0.5);
		width: 100%;
		height: 100%;
		position: fixed;
		z-index: 1;
		overflow: auto;
	}
	
	#popup_inhalt {
		width: 50%;
		height: 70px;
		margin-top: 30px;
		margin-left: 3%;
		padding: 20px;
		text-align: center;
        vertical-align: middle;
		background-color: white;
	}
</style>
<a href="?popupSchliessen">
<div id="popup_hintergrund">
	<div id="popup_inhalt">
	<h3>Erfolgreich gespeichert</h3>
	</div>
</div>
</a>
<?php	

	}}
?>
