<p>
<?php
if(isset($_COOKIE['filter'])){
  $value_datum = $_COOKIE['datum'];
  $value_schueler = $_COOKIE['schueler'];
  $value_klasse = $_COOKIE['klasse'];
  $value_gemacht = $_COOKIE['gemacht'];
} else {
  $value_datum = date("Y-m-d");
  $value_schueler = '%';
  $value_klasse = '%';
  $value_gemacht = '%';
}

if(isset($_GET['filter'])){
?>
<form action="_protokolle_filtern_cookies.php" method="post">
    <p>Datum:<input value="<?php echo $value_datum ?>" class='form-control' type='date' name='datum'></p>
    <p>Schüler:<select name="schueler" class='form-control'>

<!-- Damit nicht die % angezeigt werden, wenn Schuler ALLE ausgewählt sind -->
<?php if(isset($_COOKIE['filter'])){
      if($_COOKIE['schueler'] == '%'){
?>
      <option value="%">Alle</option>
<?php }else{  ?>
      <option><?php echo $value_schueler ?></option>
<?php }}else { ?>
      <option value="%">Alle</option>
<?php } ?>

    <?php
      $sql_schueler_filter = "SELECT email FROM schueler";
      foreach ($pdo->query($sql_schueler_filter) as $schueler_filter) {
    ?>
    <option><?php echo $schueler_filter['email']; ?></option>
    <?php } //Foreach sql-abfrage schliessen ?>
    </select></p>
    <p>Klasse:<select name="klasse" class='form-control'>

<!-- Damit nicht die % angezeigt werden, wenn KlASSEN ALLE ausgewählt sind -->
<?php if(isset($_COOKIE['filter'])){
            if($_COOKIE['klasse'] == '%'){
?>
      <option value="%">Alle</option>
<?php }else{  ?>
      <option><?php echo $value_klasse ?></option>
<?php }}else { ?>
      <option value="%">Alle</option>
<?php } ?>


    <?php
      $sql_klasse_filter = "SELECT DISTINCT klasse FROM schueler";
      foreach ($pdo->query($sql_klasse_filter) as $klasse_filter) {
    ?>
    <option><?php echo $klasse_filter['klasse']; ?></option>
    <?php } //Foreach sql-abfrage schliessen ?>
    </select></p>
    <p>Gemacht:<input value="<?php echo $value_gemacht ?>" class='form-control' type='text' name='gemacht'></p>
    <input type="submit" class="form-control" value="Filter speichern">
</form>
<?php
}else {
    echo "";
}
?>
</p>


<?php if(isset($_GET['filter'])){ ?>
<p>
<a href="?#uebersicht"><button type="button" class="btn">Abbrechen</button></a>
<a href="_protokolle_filter_zuruecksetzen.php"><button type="button" class="btn">Filter zurücksetzten</button></a>
</p>
<?php }else{ ?>
<p>
<a href="?filter=ja#uebersicht"><button type="button" class="btn">Protokolle filtern</button></a>
</p>
<?php } ?>
