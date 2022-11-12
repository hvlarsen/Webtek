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
        $sql_query = "SELECT a.Team, sum(Goals_for - Goals_against) as goaldiff, sum(Points) as points
                      FROM team_points a,
                           teams b
                      WHERE a.Team = b.Team
                      AND SimulationID = " . $SimulationID . "  
                      AND Groupname = '" . $value . "'
                      GROUP BY a.Team
                      ORDER BY points desc, goaldiff desc";
        $result = $conn->query($sql_query);
        echo "Group "."$value <br>";
        echo "<table> <tr> <th> </th> <th>GD</th> <th>points</th> </tr>";
        while ($row = $result->fetch_assoc())
        {
          echo "<tr> <td> " .$row['Team'] . " </td> <td> " .$row['goaldiff'] . " </td> <td> " .$row['points'] . " </td> </tr>" ;
        }
        echo " </table>";
        echo "</div>";
    }
    /* Udskriver gruppekampe */
    /*Echo "<h1 class = 'headerGroupMatches'> Group matches </h1>";*/
    $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
    foreach ($groups as $value){
        echo "<div class='Groupmatches" . $value . "'>";
        $sql_query = "SELECT a.Team1, a.Team2, goals1, goals2
                      FROM simulation_results a,
                           teams b
                      WHERE SimulationID = " . $SimulationID . "  
                      AND a.Team1 = b.Team
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
    $sim->simulate_round("Round of 16", $conn);
    /* Udskriver Round of 16 */
    Echo "<h1 class = 'headerRoundOf16Matches'> Round of 16 </h1>";
    echo "<div class='RoundOf16Matches'>";
    $sql_query = "SELECT a.Team1, a.Team2, goals1, goals2
                  FROM simulation_results a,
                       teams b
                  WHERE SimulationID = " . $SimulationID . "  
                  AND a.Team1 = b.Team
                  AND RoundNumber in ('Round of 16')
                  ORDER BY MatchID";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['Team1'] . " </td> <td> " . $row['goals1'] . " </td> <td> - </td> <td> " . $row['goals2'] . " </td> <td> " . $row['Team2'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    $sim->simulate_round("Quarter Finals", $conn);
    /* Udskriver Quarter Finals */
    Echo "<h1 class = 'headerQuarterFinals'> Quarter Finals </h1>";
    echo "<div class='QuarterFinals'>";
    $sql_query = "SELECT a.Team1, a.Team2, goals1, goals2
                  FROM simulation_results a,
                       teams b
                  WHERE SimulationID = " . $SimulationID . "  
                  AND a.Team1 = b.Team
                  AND RoundNumber in ('Quarter Finals')
                  ORDER BY MatchID";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['Team1'] . " </td> <td> " . $row['goals1'] . " </td> <td> - </td> <td> " . $row['goals2'] . " </td> <td> " . $row['Team2'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    $sim->simulate_round("Semi Finals", $conn);

    /* Udskriver Semi Finals */
    Echo "<h1 class = 'headerSemiFinals'> Semi Finals </h1>";
    echo "<div class='SemiFinals'>";
    $sql_query = "SELECT a.Team1, a.Team2, goals1, goals2
                  FROM simulation_results a,
                       teams b
                  WHERE SimulationID = " . $SimulationID . "  
                  AND a.Team1 = b.Team
                  AND RoundNumber in ('Semi Finals')
                  ORDER BY MatchID";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['Team1'] . " </td> <td> " . $row['goals1'] . " </td> <td> - </td> <td> " . $row['goals2'] . " </td> <td> " . $row['Team2'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    $sim->simulate_round("Finals", $conn);

    /* Udskriver Finals */
    Echo "<h1 class = 'headerFinals'> Finals </h1>";
    echo "<div class='Finals'>";
    $sql_query = "SELECT a.Team1, a.Team2, goals1, goals2
                  FROM simulation_results a,
                       teams b
                  WHERE SimulationID = " . $SimulationID . "  
                  AND a.Team1 = b.Team
                  AND RoundNumber in ('Semi Finals')
                  ORDER BY MatchID";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['Team1'] . " </td> <td> " . $row['goals1'] . " </td> <td> - </td> <td> " . $row['goals2'] . " </td> <td> " . $row['Team2'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    /* Udskriver Top 3 */
    echo "<div class='Result'>";
    $sql_query = "SELECT a.winner as gold, a.loser as silver, b.winner as bronze
                  FROM (SELECT winner, loser 
                        FROM simulation_results
                        WHERE SimulationID = " . $SimulationID . "  
                        AND matchid=64) a
                  JOIN (SELECT winner
                        FROM simulation_results
                        WHERE SimulationID = " . $SimulationID . "  
                        AND matchid=63) b";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th>  <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
       echo " <tr> <td> Gold: " . $row['gold'] . "</td> <td>  Silver: " . $row['silver'] . "</td> <td> Bronze: " . $row['bronze'] . "</td> </tr>" ;
    }           
    echo " </table>";
    echo "</div>";

    echo "<form class=simButton action='runSimulation.php'>";
    echo "<input type='submit' value='Start simulation'>";
    echo "</form>";


?>
</body>
</html>