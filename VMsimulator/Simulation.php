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
        /* echo "MatchID "."$value <br>"; */
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
        $sql_query = "SELECT Groupname, a.Team, sum(Points) as points
                      FROM team_points a,
                           teams b
                      WHERE a.Team = b.Team
                      GROUP BY Groupname, a.Team
                      ORDER BY Groupname, points desc";
        $result = $conn->query($sql_query);
        while ($row = $result->fetch_assoc())
        {
          echo $row['Groupname'] . $row['Team'] . $row['points'] . "<br>";
        }
      }
    }

    /* Method der opgør placeringerne i grupperne */ 
    function update_matches($round)
    {
      
    } 





  }
?>