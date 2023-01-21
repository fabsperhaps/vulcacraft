<?php
session_start();
if(!isset($_SESSION['username'])) {
  //Benutzer ist nicht angemeldet
  header('location: login.php');
  exit();
}

$target_dir = "uploads/";
$username = $_SESSION['username'];
$file_name = $_FILES["fileToUpload"]["name"];
$target_file = $target_dir . $username . '_' . $file_name;
$uploadOk = 1;

// Prüfungen durchführen
if (file_exists($target_file)) {
    echo "Sorry, die Datei existiert bereits.";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, die Datei ist zu groß.";
    $uploadOk = 0;
}

if ($uploadOk != 0) {
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //Verbindung zur Datenbank aufbauen
    $conn = mysqli_connect("45.10.24.8", "Fabsperhaps", "Fabiian21!", "VCpanelweb");
    //Speichern des Datei-Eintrags in der Datenbank
    $query = "INSERT INTO files (username, file_name, expires) VALUES ('$username', '$file_name', DATE_ADD(NOW(), INTERVAL 5 DAY))";
    mysqli_query($conn, $query);
    echo "Die Datei ". $file_name. " wurde erfolgreich hochgeladen. Hier ist Ihr Download-Link: ";
    echo '<a href="'.$target_file.'">'.$file_name.'</a>';
    } else {
        echo "Es gab einen Fehler beim Hochladen der Datei.";
    }
}

// Automatische Löschung nach 5 Tagen
$query = "DELETE FROM files WHERE expires < NOW()";
mysqli_query($conn, $query);

?>
