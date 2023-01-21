<?php
session_start();
if(!isset($_SESSION['username'])) {
  //Benutzer ist nicht angemeldet
  header('location: login.php');
}
?>
<form action="upload_file.php" method="post" enctype="multipart/form-data">
  <label for="fileToUpload">Datei zum Hochladen auswählen:</label>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Hochladen" name="submit">

</form>
