<?php
  /* Logger på databasen vmsimulator */
  require_once "login.php";
  require_once "Functions.php";
   
  /* Udskriver grupperne */ 
  $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
  foreach ($groups as $value){
    $sql_query = "SELECT name FROM teams where groupname='$value';";
    $result = $conn->query($sql_query);
    echo "Group "."$value <br>";
    while ($row = $result->fetch_assoc())
    {
      echo htmlspecialchars($row['name']) ."<br>" ;
    }
    echo "<br>";
  }

  /* Udskriver kampene */
  $matches = range(1,64);
  foreach ($matches as $value){
    $sql_query = "SELECT team1, team2 FROM matches where matchID='$value';";
    $result = $conn->query($sql_query);
    /* echo "MatchID "."$value <br>"; */
    while ($row = $result->fetch_assoc())
    {
      echo htmlspecialchars($row['team1'])." - " ;
      echo htmlspecialchars($row['team2']) ."<br>" ;
    }
  }

  /* Knap der kan køre simulationen */
?>
