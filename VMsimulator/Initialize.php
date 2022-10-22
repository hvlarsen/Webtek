<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Hans Larsen">
        <title>World Cup simulator</title>
    </head>
<body>

<link rel='stylesheet' href='styles.css'>

<?php 
  require_once "login.php";
    /* Udskriver grupperne */ 
    $groups = array("A", "B", "C", "D", "E", "F", "G", "H");
    foreach ($groups as $value){
        echo "<div class='Group" . $value . "'>";
        $sql_query = "SELECT a.Team, sum(Goals_for - Goals_against) as goaldiff, sum(Points) as points
                      FROM team_points a,
                           teams b
                      WHERE a.Team = b.Team
                      AND Groupname = '" . $value . "'
                      GROUP BY a.Team
                      ORDER BY points desc, goaldiff desc";
        $result = $conn->query($sql_query);
        echo "Group "."$value <br>";
        echo "<table> <tr> <th></th> <th>GD</th> <th>points</th> </tr>";
        while ($row = $result->fetch_assoc())
        {
          echo "<tr> <td> " .$row['Team'] . " </td> <td> " .$row['goaldiff'] . " </td> <td> " .$row['points'] . " </td> </tr>" ;
        }
        echo " </table>";
        echo "</div>";
    }
?>

</body>


</html>