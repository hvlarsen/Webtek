<?php
  /* Connecter til databasen VMsimulator */
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "vmsimulator";
  $conn = new mysqli($servername, $username, $password, $dbname); 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  /*  echo "Connected succesfully."; */
?>
