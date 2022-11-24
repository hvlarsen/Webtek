<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Hans Larsen">
        <title>World Cup simulator</title>
    </head>
<body>

<link rel='stylesheet' href='styles.css'>

<h1 class = 'WCheader'> FIFA World Cup 2022 Simulator </h1>
<img src="world cup trophy.png" class="worldcuptrophy_img" alt="world cup trophy">
<img src="silver medal.png" class="silvermedal_img" alt="world cup trophy">
<img src="bronze medal.png" class="bronzemedal_img" alt="world cup trophy">

<?php 
  require_once "login.php";


    /* Udskriver grupperne */ 
    $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
    foreach ($groups as $value){
        echo "<div class='Group" . $value . "'>";
        $sql_query = "SELECT b.teamname, '0' as goaldiff, /*sum(Goals_for - Goals_against) as goaldiff, sum(Points)*/ '0' as points
                      FROM team_points a,
                           teams b
                      WHERE a.Team = b.Team
                      AND Groupname = '" . $value . "'
                      GROUP BY a.Team
                      ORDER BY points desc, goaldiff desc";
        $result = $conn->query($sql_query);
        echo "Group "."$value <br>";
        echo "<table> <tr> <th> </th> <th>GD</th> <th>P</th> </tr>";
        while ($row = $result->fetch_assoc())
        {
          echo "<tr> <td> " .$row['teamname'] . " </td> <td> " .$row['goaldiff'] . " </td> <td> " .$row['points'] . " </td> </tr>" ;
        }
        echo " </table>";
        echo "</div>";
    }


    /* Udskriver gruppekampe */
    /* Echo "<h1 class = 'headerGroupMatches'> Group matches </h1>";*/
    $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
    foreach ($groups as $value){
        echo "<div class='Groupmatches" . $value . "'>";
        $sql_query = "SELECT b.teamname as Team1, c.teamname as Team2
                      FROM matches a,
                           teams b,
                           teams c
                      WHERE a.Team1 = b.Team
                      AND a.Team2 = c.team
                      AND b.Groupname = '" . $value . "'
                      ORDER BY Date";
        $result = $conn->query($sql_query);
        echo "<table> <tr> <th></th> <th></th> <th></th> </tr>";
        while ($row = $result->fetch_assoc())
        {
          echo "<tr> <td> " . $row['Team1'] . " </td> <td> _ - _ </td> <td> " . $row['Team2'] . "</td> </tr>" ;
        }
        echo " </table>";
        echo "</div>";
    }

    /* Generel funktion, der udskriver knockout-runderne */
    function write_round($round,$conn)
    {
        $sql_query = "SELECT MatchID, Team1_source, Team2_source
                      FROM matches a
                      WHERE RoundNumber = '" . $round . "'
                      ORDER BY Date";
        $result = $conn->query($sql_query);
        echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> </tr>";
        while ($row = $result->fetch_assoc())
        {
            echo "<tr> <td> " . $row['MatchID'] . " </td><td> " . $row['Team1_source'] . "</td> <td> _ - _ </td> <td> " . $row['Team2_source'] . "</td> </tr>" ;
        }
        echo " </table>";
    }
    
    /* Udskriver Round of 16 */
    Echo "<h1 class = 'headerRoundOf16Matches'> Round of 16 </h1>";
    echo "<div class='RoundOf16Matches'>";
    write_round('Round of 16',$conn);
    echo "</div>";

    /* Udskriver Quarter Finals */
    Echo "<h1 class = 'headerQuarterFinals'> Quarter Finals </h1>";
    echo "<div class='QuarterFinals'>";
    write_round('Quarter Finals',$conn);
    echo "</div>";

    /* Udskriver Semi Finals */
    Echo "<h1 class = 'headerSemiFinals'> Semi Finals </h1>";
    echo "<div class='SemiFinals'>";
    write_round('Semi Finals',$conn);
    echo "</div>";

    /* Udskriver Finals */
    Echo "<h1 class = 'headerFinals'> Finals </h1>";
    echo "<div class='Finals'>";
    write_round('Finals',$conn);
    echo "</div>";

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