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

<?php 
  require_once "login.php";
    /* Udskriver grupperne */ 
    $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
    foreach ($groups as $value){
        echo "<div class='Group" . $value . "'>";
        $sql_query = "SELECT a.Team, '0' as goaldiff, /*sum(Goals_for - Goals_against) as goaldiff, sum(Points)*/ '0' as points
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
          echo "<tr> <td> " .$row['Team'] . " </td> <td> " .$row['goaldiff'] . " </td> <td> " .$row['points'] . " </td> </tr>" ;
        }
        echo " </table>";
        echo "</div>";
    }


    /* Udskriver gruppekampe */
    /* Echo "<h1 class = 'headerGroupMatches'> Group matches </h1>";*/
    $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
    foreach ($groups as $value){
        echo "<div class='Groupmatches" . $value . "'>";
        $sql_query = "SELECT a.Team1, a.Team2
                      FROM matches a,
                           teams b
                      WHERE a.Team1 = b.Team
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

    /* Udskriver Round of 16 */
    Echo "<h1 class = 'headerRoundOf16Matches'> Round of 16 </h1>";
    echo "<div class='RoundOf16Matches'>";
    $sql_query = "SELECT MatchID, Team1_source, Team2_source
                    FROM matches a
                    WHERE RoundNumber = 'Round of 16'
                    ORDER BY Date";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['MatchID'] . " </td><td> " . $row['Team1_source'] . "</td> <td> _ - _ </td> <td> " . $row['Team2_source'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    /* Udskriver Quarter Finals */
    Echo "<h1 class = 'headerQuarterFinals'> Quarter Finals </h1>";
    echo "<div class='QuarterFinals'>";
    $sql_query = "SELECT MatchID, Team1_source, Team2_source
                    FROM matches a
                    WHERE RoundNumber = 'Quarter Finals'
                    ORDER BY Date";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['MatchID'] . " </td><td> " . $row['Team1_source'] . "</td> <td> _ - _ </td> <td> " . $row['Team2_source'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    /* Udskriver Semi Finals */
    Echo "<h1 class = 'headerSemiFinals'> Semi Finals </h1>";
    echo "<div class='SemiFinals'>";
    $sql_query = "SELECT MatchID, Team1_source, Team2_source
                    FROM matches a
                    WHERE RoundNumber = 'Semi Finals'
                    ORDER BY Date";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['MatchID'] . " </td><td> " . $row['Team1_source'] . "</td> <td> _ - _ </td> <td> " . $row['Team2_source'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    /* Udskriver Finals */
    Echo "<h1 class = 'headerFinals'> Finals </h1>";
    echo "<div class='Finals'>";
    $sql_query = "SELECT MatchID, Team1_source, Team2_source
                    FROM matches a
                    WHERE RoundNumber = 'Finals'
                    ORDER BY Date";
    $result = $conn->query($sql_query);
    echo "<table> <tr> <th></th> <th></th> <th></th> <th></th> </tr>";
    while ($row = $result->fetch_assoc())
    {
        echo "<tr> <td> " . $row['MatchID'] . " </td><td> " . $row['Team1_source'] . "</td> <td> _ - _ </td> <td> " . $row['Team2_source'] . "</td> </tr>" ;
    }
    echo " </table>";
    echo "</div>";

    echo "<form class=simButton action='runSimulation.php'>";
    echo "<input type='submit' value='Start simulation'>";
    echo "</form>";
    
    
?>
</body>
</html>