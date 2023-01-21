<?php
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];

  //Verbindung zur Datenbank aufbauen
  $conn = mysqli_connect("45.10.24.8", "Fabsperhaps", "Fabiian21!", "VCpanelweb");

  //Überprüfung des Benutzers in der Datenbank
  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 1) {
    //Benutzerdaten sind korrekt
    $_SESSION['username'] = $username;
    header('location: upload.php');
  } else {
    //Benutzerdaten sind nicht korrekt
    echo "Falscher Benutzername oder Passwort. Bitte versuchen Sie es erneut.";
  }
?>
