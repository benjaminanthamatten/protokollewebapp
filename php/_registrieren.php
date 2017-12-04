<?php
include('_db_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registrieren
  </title>
  <link rel="stylesheet" href="../css/login.css">
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>
<body>
  <div class="login-registr">
  <div class="titel-box">
    <h1>Registrieren</h1>
  </div>
  <div class="form">

<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
 $error = false;
 $email = $_POST['email'];
 $klasse = $_POST['klasse'];
 $passwort = $_POST['passwort'];
 $passwort2 = $_POST['passwort2'];

 if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
 $error = true;
 }
 if(strlen($passwort) == 0) {
 echo 'Bitte ein Passwort angeben<br>';
 $error = true;
 }
 if($passwort != $passwort2) {
 echo 'Die Passwörter müssen übereinstimmen<br>';
 $error = true;
 }

 //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
 if(!$error) {
 $statement = $pdo->prepare("SELECT * FROM schueler WHERE email = :email");
 $result = $statement->execute(array('email' => $email));
 $user = $statement->fetch();

 if($user !== false) {
 echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
 $error = true;
 }
 }

 //Keine Fehler, wir können den Nutzer registrieren
 if(!$error) {
 $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

 $statement = $pdo->prepare("INSERT INTO schueler (email, passwort, klasse) VALUES (:email, :passwort, :klasse)");
 $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'klasse' => $klasse));

 if($result) {
 session_start();
 $_SESSION['email'] = $email;
 header('Location: _startseite.php');
 $showFormular = false;
 } else {
 echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
 }
 }
}

if($showFormular) {
?>

<form action="?register=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>

Klasse:<br>
<select name="klasse">
<option>ME1</option>
<option>ME2</option>
<option>ME3</option>
<option>ME4</option>
</select><br><br>

Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>

Passwort wiederholen:<br>
<input type="password" size="40" maxlength="250" name="passwort2"><br><br>

<input class="submit" type="submit" value="abschicken">
</form>

<?php
} //Ende von if($showFormular)
?>
 </div>
 </div>
 <div class="link">
   <a class="link" href="_login.php">Zurück zum Login</a>
 </div>
</body>
</html>
