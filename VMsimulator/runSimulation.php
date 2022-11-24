<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Hans Larsen">
        <title>World Cup simulator</title>
    </head>
<body>

<link rel='stylesheet' href='styles.css'>

<h1 class = 'WCheader'> FIFAWorld Cup 2022 Simulator </h1>
<img src="world cup trophy.png" class="worldcuptrophy_img" alt="world cup trophy">
<img src="silver medal.png" class="silvermedal_img" alt="world cup trophy">
<img src="bronze medal.png" class="bronzemedal_img" alt="world cup trophy">

<?php
   global $conn;
   require_once "login.php";
   require_once "Functions.php";
   require_once "Match_.php";
   require_once "Team.php";
   require_once "Simulation.php";
   $sim = new Simulation($conn);
   $sim->simulate_round("1", $conn);
   $sim->simulate_round("2", $conn);
   $sim->simulate_round("3", $conn);

   $SimulationID = $sim->SimulationID;
    /* Udskriver grupperne */ 
    $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
    foreach ($groups as $value){
        echo "<div class='Group" . $value . "'>";
        $sql_query = "SELECT teamname, sum(Goals_for - Goals_against) as goaldiff, sum(Points) as points
                      FROM team_points a,
                           teams b
                      WHERE a.Team = b.Team
                      AND SimulationID = " . $SimulationID . "  
                      AND Groupname = '" . $value . "'
                      GROUP BY teamname
                      ORDER BY points desc, goaldiff desc";
        $result = $conn->query($sql_query);
        echo "Group "."$value <br>";
        echo "<table> <tr> <th> </th> <th>GD</th> <th>points</th> </tr>";
        while ($row = $result->fetch_assoc())
        {
          echo "<tr> <td> " .$row['teamname'] . " </td> <td> " .$row['goaldiff'] . " </td> <td> " .$row['points'] . " </td> </tr>" ;
        }
        echo " </table>";
        echo "</div>";
    }
    /* Udskriver gruppekampe */
    /*Echo "<h1 class = 'headerGroupMatches'> Group matches </h1>";*/
    $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
    foreach ($groups as $value){
        echo "<div class='Groupmatches" . $value . "'>";
        $sql_query = "SELECT b.teamname as Team1, c.teamname as Team2, goals1, goals2
                      FROM simulation_results a,
                           teams b,
                           teams c
                      WHERE SimulationID = " . $SimulationID . "  
                      AND a.Team1 = b.Team
                      AND a.Team2 = c.team
                      AND RoundNumber in ('1', '2', '3')
                      AND b.Groupname = '" . $value . "'
                      ORDER BY MatchID";
        $result = $conn->query($sql_query);
        echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>";
        while ($row = $result->fetch_assoc())
        {
          echo "<tr> <td> " . $row['Team1'] . " </td> <td> " . $row['goals1'] . " </td> <td> - </td> <td> " . $row['goals2'] . " </td> <td> " . $row['Team2'] . "</td> </tr>" ;
        }
        echo " </table>";
        echo "</div>";
    }

    /* Generel funktion, der udskriver knockout-runderne */
    function write_round($round,$conn, $SimulationID)
    {
        $sql_query = "SELECT b.teamname as Team1, c.teamname as Team2, goals1, goals2
        FROM simulation_results a,
             teams b,
             teams c
        WHERE SimulationID = " . $SimulationID . "  
        AND a.Team1 = b.Team
        AND a.Team2 = c.team
        AND RoundNumber in ('" . $round . "')
        ORDER BY MatchID";
        $result = $conn->query($sql_query);
        echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>";
        while ($row = $result->fetch_assoc())
        {
           echo "<tr> <td> " . $row['Team1'] . " </td> <td> " . $row['goals1'] . " </td> <td> - </td> <td> " . $row['goals2'] . " </td> <td> " . $row['Team2'] . "</td> </tr>" ;
        }
        echo " </table>";
    }

    $sim->simulate_round("Round of 16", $conn);
    /* Udskriver Round of 16 */
    Echo "<h1 class = 'headerRoundOf16Matches'> Round of 16 </h1>";
    echo "<div class='RoundOf16Matches'>";
    write_round('Round of 16', $conn, $SimulationID);
    echo "</div>";

    $sim->simulate_round("Quarter Finals", $conn);
    /* Udskriver Quarter Finals */
    Echo "<h1 class = 'headerQuarterFinals'> Quarter Finals </h1>";
    echo "<div class='QuarterFinals'>";
    write_round('Quarter Finals', $conn, $SimulationID);
    echo "</div>";

    $sim->simulate_round("Semi Finals", $conn);
    /* Udskriver Semi Finals */
    Echo "<h1 class = 'headerSemiFinals'> Semi Finals </h1>";
    echo "<div class='SemiFinals'>";
    write_round('Semi Finals', $conn, $SimulationID);
    echo "</div>";

    $sim->simulate_round("Finals", $conn);
    /* Udskriver Finals */
    Echo "<h1 class = 'headerFinals'> Finals </h1>";
    echo "<div class='Finals'>";
    write_round('Finals', $conn, $SimulationID);
    echo "</div>";

    /* Udskriver Top 3 */
    $sql_query = "SELECT a.winner as gold, a.loser as silver, b.winner as bronze
                  FROM (SELECT b.teamname as winner, c.teamname as loser 
                        FROM simulation_results a,
                             teams b,
                             teams c
                        WHERE SimulationID = " . $SimulationID . "
                        AND matchid=64
                        AND winner = b.team
                        and loser = c.team) a
                  JOIN (SELECT b.teamname as winner
                        FROM simulation_results a,
                            teams b
                        WHERE SimulationID = " . $SimulationID . " 
                        AND matchid=63
                        AND winner = b.team) b";
    $result = $conn->query($sql_query);
    while ($row = $result->fetch_assoc())
    {
      $winner = $row['gold'];
      $silver = $row['silver'];
      $bronze = $row['bronze'];
    }           

    Echo "<h1 class = 'winner'> " . $winner . "</h1>";
    Echo "<h1 class = 'silver'> " . $silver . "</h1>";
    Echo "<h1 class = 'bronze'> " . $bronze . "</h1>";

    /* Udskriver Odds-tabel */
    echo "<div class='Oddstable'>";
    $sql_query = "SELECT b.teamname as winner, no_of_wins, pct, odds
                  FROM (SELECT winner, count(*) AS no_of_wins, 
                               count(*)/(SELECT count(*) FROM vmsimulator.simulation_results WHERE MatchID=64) AS pct, 
                               (SELECT count(*) FROM vmsimulator.simulation_results WHERE MatchID=64)/count(*) AS odds
                        FROM vmsimulator.simulation_results
                        WHERE MatchID=64
                        GROUP BY winner
                        ) a,
                        teams b
                  WHERE a.winner = b.team
                  ORDER BY no_of_wins DESC";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th>Number of wins</th> <th>Probability of winning</th> <th>Fair odds</th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['winner'] . " </td><td class='rightalign'> " . $row['no_of_wins'] . "</td> <td class='rightalign'>" . $row['pct'] . "</td> <td class='rightalign'>" . $row['odds'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    echo "<form class=simButton action='runSimulation.php'>";
    echo "<input type='submit' value='Start simulation'>";
    echo "</form>";


?>
</body>
</html>