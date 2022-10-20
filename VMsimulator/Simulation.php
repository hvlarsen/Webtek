<?php
  class Simulation
  {
    
    /* contrutor funktion, der sætter de to teamnavne */
    function __construct()
    {

    }

    /* Method, der simulerer resultaterne af gruppekampe */   
    function simulate_round($round, $conn) /* round in ("1", "2", "3", "Round of 16", "Quarter Finals", "Semi Finals", "Finals") */
    {
      echo "<br>" . $round . "<br>";
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
        $sql_query = "SELECT team1, team2 FROM matches where matchID='$value';";
        $result = $conn->query($sql_query);
        while ($row = $result->fetch_assoc())
        {
          $team1 = new team(htmlspecialchars($row['team1']), $conn);
          $team2 = new team(htmlspecialchars($row['team2']), $conn);
          $team1->load_strength($team1->conn);
          $team2->load_strength($team2->conn);
          $match = new Match_($team1, $team2);
          $match->play();
          $match->update_match($conn);
          echo $team1->name . "(" . $team1->attack . " , " . $team1->defense . ") - " . $team2->name . "(" . $team2->attack . " , " . $team2->defense . ") " 
               . $match->goals1 . " - " . $match->goals2 . "<br>";
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
          echo $group . $rank . $row['Team'] . $row['points'] . "<br>";
          /* Opdaterer turneringsplanen */
          $sql_query = "UPDATE matches SET Team1 = '" .  $row['Team'] . "' WHERE Team1_source = '" . $rank . $group . "';";
          $conn->query($sql_query);
          $sql_query = "UPDATE matches SET Team2 = '" .  $row['Team'] . "' WHERE Team2_source = '" . $rank . $group . "';";
          $conn->query($sql_query);
          $rank++;
        }
      }
      if ($round == "Round of 16" or $round == "Quarter Finals" or $round == "Semi Finals")
      {
        /* Opdaterer turneringsplanen */
        $sql_query = "SELECT MatchID, winner, loser FROM matches WHERE RoundNumber = '" . $round. "';";
        $result = $conn->query($sql_query);
        while ($row = $result->fetch_assoc())
        {
          $sql_query = "UPDATE matches SET Team1 = '" .  $row['winner'] . "' WHERE Team1_source = 'W" . $row['MatchID'] . "';";
          $conn->query($sql_query);
          $sql_query = "UPDATE matches SET Team2 = '" .  $row['winner'] . "' WHERE Team2_source = 'W" . $row['MatchID'] . "';";
          $conn->query($sql_query);
          $sql_query = "UPDATE matches SET Team1 = '" .  $row['loser'] . "' WHERE Team1_source = 'L" . $row['MatchID'] . "';";
          $conn->query($sql_query);
          $sql_query = "UPDATE matches SET Team2 = '" .  $row['loser'] . "' WHERE Team2_source = 'L" . $row['MatchID'] . "';";
          $conn->query($sql_query);
        }
      }
    }
  }
?>