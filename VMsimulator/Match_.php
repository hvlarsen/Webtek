<?php
  class Match_ 
  {
    public $team1, $team2;
    public $goals1, $goals2;

    /* contructor funktion, der sætter de to teamnavne */
    function __construct($team1, $team2)
    {
      $this->team1 = $team1;
      $this->team2 = $team2;
    }

    /* Funktion der spiller en kamp */   
    function play()
    {
      $avg = 1.5;
      /* Henter holdenes strength */
      $attack_team1  = $this->team1->get_attack();
      $defense_team1 = $this->team1->get_defense();
      $attack_team2  = $this->team2->get_attack();
      $defense_team2 = $this->team2->get_defense();

      /* Beregner E[xG] for hvert team: */
      $ExG1 = $attack_team1 * $defense_team2 * $avg;
      $ExG2 = $attack_team2 * $defense_team2 * $avg;

      /* Beregner xG for hvert hold tilfældigt generet fra gamma-fordeling med middelværdi E[xG] */
      $xG1 = generategamma(15, 15/$ExG1);
      // echo  "ExG1 = " . $ExG1 . "   xG1 = " . $xG1 . "<br>";
      $xG2 = generategamma(15, 15/$ExG2);

      /* Beregner for hvert hold tilfældigt antal mål taget fra Poisson-fordeling med middelværdi xG */
      $this->goals1 = generatepoisson($xG1);
      $this->goals2 = generatepoisson($xG2);
    }

    /* Method, der opdaterer db med resultatet af match */
    function update_match($conn, $SimulationID)
    {
      /* Opdaterer simulation_results tabellen */
      $sql_query = "UPDATE simulation_results SET goals1 = " . $this->goals1 . ", goals2 = " . $this->goals2 . ", played = 1 " . 
                   "where Team1 = '" . $this->team1->name . "' and Team2 = '" . $this->team2->name . "' AND SimulationID = " . $SimulationID . ";";
      $conn->query($sql_query);

      /* !!! Der skal gøres et eller andet her, så det ikke altid er Team1 der er vinderen ved uafgjort (forlænget spilletid og straffe)*/
      if ($this->goals1 > $this->goals2)
      {
        $winner = $this->team1->name;
        $loser  = $this->team2->name;
      }
      else 
      { 
        $winner = $this->team2->name;
        $loser  = $this->team1->name;
      }
      
      $sql_query = "UPDATE  simulation_results SET winner = '" . $winner . "',  loser = '" . $loser . "' 
                    WHERE Team1 = '" . $this->team1->name . "' 
                    AND Team2 = '" . $this->team2->name . "' 
                    AND SimulationID = " . $SimulationID . ";";
      $conn->query($sql_query);

      /* Opdaterer team_points tabellen */
      $sql_query = "INSERT INTO team_points (Team, Points, Goals_for, Goals_against) 
                    VALUES ('" . $this->team1->name . "', " . (($this->goals1 > $this->goals2)*3 + ($this->goals1 == $this->goals2)*1). ",
                            " . $this->goals1 . ", " . $this->goals2 . ");"; 
      $conn->query($sql_query);

      /* Opdaterer team_strength tabellen */
    }
  }
?>