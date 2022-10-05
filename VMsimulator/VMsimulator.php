<?php
  /* Connecter til databasen VMsimulator */
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "vmsimulator";
  $conn = new mysqli($servername, $username, $password, $dbname); 

  /* Udskriver grupperne */
  $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
  foreach ($groups as $value){
    $sql_query = "SELECT team AS A FROM teams where groupname='$value';";
    $result = $conn->query($sql_query);
    echo "Group "."$value <br>";
    while ($row = $result->fetch_assoc())
    {
      echo htmlspecialchars($row['A']) ."<br>" ;
    }
    echo "<br>";
  }
?>
