<!-- MYSQL-Abfragen & PHP-Includes -->

<?php
include('_db_connect.php');

?>


<!DOCTYPE html>
<html lang="en">

  <head>

	<?php include('_header.php'); ?>

  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Protokolle</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#registrieren">Registrieren</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="login">
        <div class="my-auto">
          <?php

          if(isset($_GET['login'])) {
           $email = $_POST['email'];
           $passwort = $_POST['passwort'];

           $statement = $pdo->prepare("SELECT * FROM schueler WHERE email = :email");
           $result = $statement->execute(array('email' => $email));
           $user = $statement->fetch();

           //Überprüfung des Passworts
           if ($user !== false && password_verify($passwort, $user['passwort'])) {
           $_SESSION['email'] = $email;
           header('Location: _startseite.php');
           } else {
           $errorMessage = "E-Mail oder Passwort war ungültig<br>";
           }

          }
          ?>
          <?php
          if(isset($errorMessage)) {
           echo $errorMessage;
          }
          ?>
          <div class="login-registr">
          <div class="titel-box">
            <h1>Login</h1>
          </div>
          <div class="form">
          <form action="?login=1" method="post">
          E-Mail:<br>
          <input class='form-control' type="email" size="40" maxlength="250" name="email"><br><br>

          Dein Passwort:<br>
          <input class="form-control" type="password" size="40"  maxlength="250" name="passwort"><br>
          <br>
          <input class="btn" class="submit" type="submit" value="login">
          </form>

        </div>
      </section>


  <!-- REGISTIREREN -->


  <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="registrieren">
    <div class="my-auto">
      <?php
?>
      <h1>Registrieren</h1>
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
  <input class='form-control' type="email" size="40" maxlength="250" name="email"><br><br>

  Klasse:<br>
  <select class='form-control' name="klasse">
  <option>ME1</option>
  <option>ME2</option>
  <option>ME3</option>
  <option>ME4</option>
  </select><br><br>

  Dein Passwort:<br>
  <input class='form-control' type="password" size="40"  maxlength="250" name="passwort"><br>

  Passwort wiederholen:<br>
  <input class='form-control' type="password" size="40" maxlength="250" name="passwort2"><br><br>

  <input class='btn' class="submit" type="submit" value="abschicken">
  </form>

  <?php
  } //Ende von if($showFormular)
  ?>

    </div>
  </section>


<!-- ENDE REGISTRIEREN -->


    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../bootstrap/js/resume.min.js"></script>

  </body>

</html>
