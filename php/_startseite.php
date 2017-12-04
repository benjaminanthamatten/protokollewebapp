<!-- MYSQL-Abfragen & PHP-Includes -->

<?php
include('_db_connect.php');

if(!isset($_SESSION['email'])){
    header('Location: ../');
}


$sql_schueler_angemeldet = "SELECT * FROM schueler WHERE email = '$email'";
foreach ($pdo->query($sql_schueler_angemeldet) as $schueler_angemeldet) {
	$schuelerID = $schueler_angemeldet['schuelerID'];
	$klasse = $schueler_angemeldet['klasse'];
}



?>


<!DOCTYPE html>
<html lang="en">

  <head>

	<?php include('_header.php'); ?>

  </head>
	<?php include('_popup_erfolgreich_gespeichert.php'); ?>

  <body id="page-top">


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Protokolle</span>
        <span class="d-none d-lg-block">
          <?php
          $filename = "../img/$schuelerID.jpg";

          if (file_exists($filename)) {
            ?><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="../img/<?php echo $schuelerID; ?>.jpg" alt=""><?php
          } else {
            ?><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="../img/placeholder.jpg" alt=""><?php
          }
          ?>

        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#hinzufuegen">Hinzufügen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#bearbeiten">Bearbeiten</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#uebersicht">Übersicht</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#profilbild">Profilbild</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#abmelden">Abmelden</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex d-column" id="home">
        <div class="my-auto">
          <h1 class="mb-0"><?php echo $email ?>
            <span class="text-primary"><?php echo $klasse ?></span>
          </h1>
          <ul class="list-inline list-social-icons mb-0">
            <li class="list-inline-item">
              <a href="#hinzufuegen">
                Protokoll hinzufügen
              </a>
			  |
            </li>
            <li class="list-inline-item">
              <a href="#bearbeiten">
                Protokolle bearbeiten
              </a>
			  |
            </li>
            <li class="list-inline-item">
              <a href="#uebersicht">
                Übersicht
              </a>
			  |
            </li>
            <li class="list-inline-item">
              <a href="#profilbild">
                Profilbild hochladen
              </a>
        |
            </li>
            <li class="list-inline-item">
              <a href="_abmelden.php">
                Abmelden
              </a>
			  |
            </li>
          </ul>
        </div>
      </section>

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="hinzufuegen">
        <div class="my-auto">
          <h2 class="mb-5">Protokoll hinzufügen</h2>


            <!-- PROTOKOLL HINZUFUEGEN -->
            <div id="hinzufuegen">
                <form action="_protokoll_hinzufuegen.php" method="post">
                    Was habe ich gemacht: <textarea class="form-control" name="gemacht"></textarea><br>
                    Von: <input class="form-control" name="von" type="time"><br>
                    Bis: <input class="form-control" name="bis" type="time"><br>
                    Probleme: <input class="form-control" name="probleme" type="text">
                    <br><input class="btn" type="submit" name="send" value="Absenden">
                </form>
            </div>
            <!-- ENDE PROTOKOLL HINZUFUEGEN -->

        </div>

      </section>

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="bearbeiten">
        <div class="my-auto">
          <h2 class="mb-5">Protokolle bearbeiten</h2>


            <!-- PROTOKOLL BEARBEITEN (WIRD NUR ANGEZEIGT WENN DIE SESSION AKTIV IST) -->
                <p>
                <?php
                if(isset($_SESSION['bearbeiten'])){
                    if($_SESSION['bearbeiten'] == 1){
                        $id = $_SESSION['bearbeiten_id'];
                ?>
                <div class="bearbeiten">
                <?php
                        $sql_bearbeiten = "SELECT * FROM protokolle WHERE protokollID = '$id'";
                        foreach ($pdo->query($sql_bearbeiten) as $bearbeiten) {
                        ?>
                        <form action="_protokoll_bearbeiten.php?id=<?php echo $id ?>" method="post">
                        Gemacht: <textarea class='form-control' name='gemacht' type='text'><?php echo $bearbeiten['gemacht'] ?></textarea>
                        Von: <input class='form-control' name='von' type='text' value='<?php echo $bearbeiten['von'] ?>'>
                        Bis: <input class='form-control' name='bis' type='text' value='<?php echo $bearbeiten['bis'] ?>'>
                        Probleme: <input class='form-control' name='probleme' type='text' value='<?php echo $bearbeiten['probleme'] ?>'>
                        <br><input class='btn' type='submit' name='speichern' value='Änderungen speichern'>
                            <input class='btn' type='submit' name='abbrechen' value='Abbrechen'>
                        </form>
                        <?php
                    }
                ?>
                </div>
                <?php
                }}
                ?>
              </p>
            <!-- ENDE PROTOKOLL BEARBEITEN-->


          <div class="resume-item d-flex flex-column flex-md-row mb-5">


              <!-- Eigene PROTOKOLLE anzeigen -->

                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>gemacht</th>
                        <th>von</th>
                        <th>bis</th>
                        <th>Probleme</th>
                        <th>bearbeiten</th>
                        <th>löschen</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_protokolle = "SELECT * FROM protokolle WHERE schueler = '$email'";
                        foreach ($pdo->query($sql_protokolle) as $protokolle) {
                        ?>
                    <tr>
                        <td><?php echo $protokolle['gemacht'] ?></td>
                        <td><?php echo $protokolle['von'] ?></td>
                        <td><?php echo $protokolle['bis'] ?></td>
                        <td><?php echo $protokolle['probleme'] ?></td>
                        <td width="1%"><a href="_protokoll_bearbeiten.php?id=<?php echo $protokolle['protokollID'] ?>">🔧</a></td>
                        <td width="1%"><a href="_protokoll_loeschen.php?id=<?php echo $protokolle['protokollID'] ?>">❌</a></td>
                        <!-- emojis finden: https://apps.timwhitlock.info/emoji/tables/unicode -->
                    </tr>
                        <?php } ?>
                    </tbody>
                </table>
              <!-- ENDE Eigene PROTOKOLLE anzeigen -->

          </div>

        </div>
      </section>

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="uebersicht">
        <div class="my-auto">
          <h2 class="mb-5">Gesamtübersicht der Protokolle</h2>


            <!-- Protokolle des angemeldeten Schülers hervorheben -->
            <style>
                  tr.hervorheben<?php echo $schuelerID ?>{
                      color: #bd5d38;
                      font-weight: bold;
                  }
            </style>
            <!-- Ende hervorheben -->

                <!-- ALLE PROTOKOLLE anzeigen -->

                <?php
                    include('_protokolle_filtern.php');
                    if(isset($_COOKIE['filter'])){
                      $filter_datum = $_COOKIE['datum'];
                      $filter_schueler = $_COOKIE['schueler'];
                      $filter_klasse = $_COOKIE['klasse'];
                      $filter_gemacht = $_COOKIE['gemacht'];
                    }else {
                      $filter_datum = '%';
                      $filter_schueler = '%';
                      $filter_klasse = '%';
                      $filter_gemacht = '%';
                    }

                ?>


                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Datum</th>
                        <th>Schüler</th>
                        <th>Klasse</th>
                        <th>gemacht</th>
                        <th>von</th>
                        <th>bis</th>
                        <th>Probleme</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_protokolle_gesamt = "SELECT * FROM protokolle JOIN schueler ON schueler = email WHERE datum LIKE '$filter_datum' AND schueler LIKE '$filter_schueler' AND klasse LIKE '$filter_klasse' AND gemacht LIKE '%$filter_gemacht%' ORDER BY protokollID DESC";
                        foreach ($pdo->query($sql_protokolle_gesamt) as $protokolle_gesamt) {
                        ?>
                    <tr class='hervorheben<?php echo $protokolle_gesamt['schuelerID'] ?>'>
                        <td><?php echo $protokolle_gesamt['datum'] ?></td>
                        <td><?php echo $protokolle_gesamt['schueler'] ?></td>
                        <td><?php echo $protokolle_gesamt['klasse'] ?></td>
                        <td><?php echo $protokolle_gesamt['gemacht'] ?></td>
                        <td><?php echo $protokolle_gesamt['von'] ?></td>
                        <td><?php echo $protokolle_gesamt['bis'] ?></td>
                        <td><?php echo $protokolle_gesamt['probleme'] ?></td>
                    </tr>
                        <?php } ?>
                    </tbody>
                </table>
              <!-- ENDE ALLE PROTOKOLLE anzeigen -->

        </div>
      </section>

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="profilbild">
        <div class="my-auto">
        <h2 class="mb-5">Profilbild hochladen</h2>
        <!-- BILD HOCHLADEN -->

        <form action="_bild_upload.php" method="post" enctype="multipart/form-data">
        <input class="form-control" type="file" name="datei"><br>
        <input class="btn" type="submit" value="Hochladen">
        </form>

        <!-- ENDE BILD HOCHLADEN -->
      </div>
       </section>

     <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="abmelden">
        <div class="my-auto">
          <h2 class="mb-5">Abmelden</h2>
          <a href="_abmelden.php"><button type="button" class="btn"><?php echo $email; ?> abmelden</button></a>
        </div>
      </section>

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
