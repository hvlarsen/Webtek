<?php

  global $conn;
  require_once "login.php";
  require_once "Functions.php";
  require_once "Match_.php";
  require_once "Team.php";
  require_once "Simulation.php";

  /*echo(generategamma(3,3). "<br>");
  echo(generatepoisson(3) . "<br>");*/

  // $sql_query = "SELECT team1, team2 FROM matches where matchID='1';";
  // $result = $conn->query($sql_query);

  /*while ($row = $result->fetch_assoc())
    {
      echo htmlspecialchars($row['team1'])." - " ;
      echo htmlspecialchars($row['team2']) ."<br>" ;
      $team1 = new team(htmlspecialchars($row['team1']), $conn);
      $team2 = new team(htmlspecialchars($row['team2']), $conn);
    }*/

  // echo $team1->name;
  // echo $team2->name;

  /* loader strength fra databasen */
  //$team1->load_strength($team1->conn);
  // echo($team1->strength[0]. " ". $team1->strength[1] ."<br>");
  //$team2->load_strength($team2->conn);
  // echo($team2->strength[0]. " ". $team2->strength[1] ."<br>");

  // $match = new Match_($team1, $team2);
  // $match->play();
  // echo $team1->name . " " . $match->goals1 . " - " . $team2->name . " " . $match->goals2;

  // $match->update_match($conn);
   
  $sim = new Simulation($conn);
  $sim->simulate_round("1", $conn);
  $sim->simulate_round("2", $conn);
  $sim->simulate_round("3", $conn);
  $sim->simulate_round("Round of 16", $conn);
  $sim->simulate_round("Quarter Finals", $conn);
  $sim->simulate_round("Semi Finals", $conn);
  $sim->simulate_round("Finals", $conn);
   

//  $match = new Match_($team1, $team2);

//  $match->play();

  /*echo(rand() . "<br>");
  echo(rand() . "<br>");
  echo(rand(10,100));*/

  /* phpinfo(); */
  /* print_r(get_loaded_extensions());*/

  /*dl('php_stats.dll');*/
  /* a = stats_rand_gen_gamma(3, 3)*/ 
  
?>

