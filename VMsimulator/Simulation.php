<?php
  class Simulation
  {
    public $SimulationID;

    /* contrutor, opretter nyt SimulationID  */
    function __construct($conn)
    {
      /* Opretter simulationid i simulations */
      $user = 'localhost'; // Skal ændres til brugeren, der opretter simulationen
      $Date = date('Y-m-d h:i:s');
      $sql_query = "INSERT INTO simulations (User , Date) VALUES ('" . $user . "', '" . $Date . "');";
      $conn->query($sql_query);

      /* Sætter Simid */
      $sql_query = "SELECT max(SimulationID) as SimulationID FROM simulations;";
      $result = $conn->query($sql_query);
      while ($row = $result->fetch_assoc())
      {
        $this->SimulationID = $row['SimulationID'];
      }

      /* Opretter skelet til ny simulation_results */
      $sql_query = "SELECT * FROM matches;";
      $result = $conn->query($sql_query);
      while ($row = $result->fetch_assoc())
      {
        $sql_query = "INSERT INTO simulation_results (SimulationID, MatchID, Roundnumber, Team1, Team2, goals1, goals2, winner, loser, played, Team1_source, Team2_source) 
                      VALUES (" . $this->SimulationID . ", " . $row['MatchID'] . ", '" . $row['RoundNumber'] . "','" . $row['Team1'] . "','" . $row['Team2'] . "',
                      " . $row['goals1'] . "," . $row['goals2'] . ",'" . $row['winner'] . "','" . $row['loser'] . "'," . $row['played'] . ",
                      '" . $row['Team1_source'] . "', '" . $row['Team2_source'] . "');";
        $conn->query($sql_query);
      }

      /* Nulstiller points i alle grupper*/
      $sql_query = "SELECT * FROM matches;";
      $result = $conn->query($sql_query);
    }

    /* Method, der simulerer resultaterne af gruppekampe */   
    function simulate_round($round, $conn) /* round in ("1", "2", "3", "Round of 16", "Quarter Finals", "Semi Finals", "Finals") */
    {
      // echo "<br>" . $round . "<br>";
      /* Finder rundens kampe */
      $matches = array();
      $sql_query = "SELECT Matchid FROM matches where RoundNumber='$round';";
      $result = $conn->query($sql_query);
      while ($row = $result->fetch_assoc())
      {
        $matches[] = $row['Matchid'];
      }

      /* spiller rundens kampe */
      foreach ($matches as $value){
        $sql_query = "SELECT team1, team2 FROM simulation_results WHERE matchID='$value' AND SimulationID =" .  $this->SimulationID . ";";
        $result = $conn->query($sql_query);
        while ($row = $result->fetch_assoc())
        {
          $team1 = new team(htmlspecialchars($row['team1']), $conn);
          $team2 = new team(htmlspecialchars($row['team2']), $conn);
          $team1->load_strength($team1->conn);
          $team2->load_strength($team2->conn);
          $match = new Match_($team1, $team2);
          $match->play();
          $match->update_match($conn, $this->SimulationID);
          /* echo $team1->name . "(" . $team1->attack . " , " . $team1->defense . ") - " . $team2->name . "(" . $team2->attack . " , " . $team2->defense . ") " 
               . $match->goals1 . " - " . $match->goals2 . "<br>";*/
        }
      }

      /* Opdaterer turneringsplanen med de hold, der er gået videre */
      if ($round == "3")
      {
        /* Opdaterer stillingen i alle grupperne */
        $sql_query = "SELECT Groupname, a.Team, sum(Points) as points, sum(Goals_for - Goals_against) as goaldiff
                      FROM team_points a,
                           teams b
                      WHERE a.Team = b.Team
                      AND SimulationID =" . $this->SimulationID . "
                      GROUP BY Groupname, a.Team
                      ORDER BY Groupname, points desc, goaldiff desc";
        $result = $conn->query($sql_query);
        $group = "A";
        $rank = 1;
        while ($row = $result->fetch_assoc())
        {
          if ($row['Groupname'] != $group)
          {
            $group = $row['Groupname'];
            $rank = 1;
          }
          // echo $group . $rank . $row['Team'] . $row['points'] . "<br>";
          /* Opdaterer turneringsplanen */
          $sql_query = "UPDATE simulation_results SET Team1 = '" .  $row['Team'] . "' WHERE SimulationID =" . $this->SimulationID . " AND Team1_source = '" . $rank . $group . "';";
          $conn->query($sql_query);
          $sql_query = "UPDATE simulation_results SET Team2 = '" .  $row['Team'] . "' WHERE SimulationID =" . $this->SimulationID . " AND Team2_source = '" . $rank . $group . "';";
          $conn->query($sql_query);
          $rank++;
        }
      }
      if ($round == "Round of 16" or $round == "Quarter Finals" or $round == "Semi Finals")
      {
        /* Opdaterer turneringsplanen */
        $sql_query = "SELECT MatchID, winner, loser FROM simulation_results WHERE SimulationID =" . $this->SimulationID . " AND RoundNumber = '" . $round. "';";
        $result = $conn->query($sql_query);
        while ($row = $result->fetch_assoc())
        {
          $sql_query = "UPDATE simulation_results SET Team1 = '" .  $row['winner'] . "' WHERE SimulationID =" . $this->SimulationID . " AND Team1_source = 'W" . $row['MatchID'] . "';";
          $conn->query($sql_query);
          $sql_query = "UPDATE simulation_results SET Team2 = '" .  $row['winner'] . "' WHERE SimulationID =" . $this->SimulationID . " AND Team2_source = 'W" . $row['MatchID'] . "';";
          $conn->query($sql_query);
          $sql_query = "UPDATE simulation_results SET Team1 = '" .  $row['loser'] . "' WHERE SimulationID =" . $this->SimulationID . " AND Team1_source = 'L" . $row['MatchID'] . "';";
          $conn->query($sql_query);
          $sql_query = "UPDATE simulation_results SET Team2 = '" .  $row['loser'] . "' WHERE SimulationID =" . $this->SimulationID . " AND Team2_source = 'L" . $row['MatchID'] . "';";
          $conn->query($sql_query);
        }
      }
    }
  }
?>