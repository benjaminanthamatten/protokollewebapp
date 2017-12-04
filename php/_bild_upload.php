<script type="text/javascript">
function countDown(init)
{
if (init || --document.getElementById( "counter" ).firstChild.nodeValue > 0 )
    window.setTimeout( "countDown()" , 1000 );
};


</script>


<?php
include('_db_connect.php');
include('_header.php');
$upload_folder = '../img/'; //Das Upload-Verzeichnis
$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));


//Überprüfung der Dateiendung
$allowed_extensions = array('jpg');
if(!in_array($extension, $allowed_extensions)) {
header("Refresh:5; _startseite.php");
?>  <body onload="countDown(true)"><h2>Automatische Rückleitung in <span id="counter">5</span> Sekunden!</h2></body><?php
 die("<h4>Ungültige Dateiendung. Nur <strong>jpg</strong>-Dateien sind erlaubt</h4>");
}

//Überprüfung der Dateigröße
$max_size = 3000*1024; //3mb KB
if($_FILES['datei']['size'] > $max_size) {
  header("Refresh:5; _startseite.php");
  ?>  <body onload="countDown(true)"><h2>Automatische Rückleitung in <span id="counter">5</span> Sekunden!</h2></body><?php
 die("<h4>Bitte keine Dateien größer 3MB hochladen</h4>");
}

//Überprüfung dass das Bild keine Fehler enthält
if(function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
 $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
 $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
 if(!in_array($detected_type, $allowed_types)) {
   header("Refresh:5; _startseite.php");
   ?>  <body onload="countDown(true)"><h2>Automatische Rückleitung in <span id="counter">5</span> Sekunden!</h2></body><?php
 die("<h4>Unglültige Datei</h4>");
 }
}

//Pfad zum Upload
$filename = $schuelerID;
$new_path = $upload_folder.$filename.'.'.$extension;


//Alles okay, verschiebe Datei an neuen Pfad
move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';
header('Location: _startseite.php');
?>
