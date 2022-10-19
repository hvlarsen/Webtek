<?php
class Fruit {
  // Properties
  public $name;
  public $color;    
  public $team1, $team2;
  private $result;
    


    /* Funktion der spiller en kamp */   
    function play()
    {
      /* Henter holdenes strength */
      $strength_team1 =  $this->team1->get_strength();
      $strength_team2 =  $this->team2->get_strength();
      $attack_team1 = $strength_team1[0];
      $defense_team1 = $strength_team1[1];
      $attack_team2 = $strength_team2[0];
      $defense_team2 = $strength_team2[1];

      /* Beregner E[xG] for hvert team: */
      $ExG1 = attack_team1 * defense_team2 * avg;
      $ExG2 = attack_team2 * defense_team2 * avg;

      /* Beregner xG for hvert hold tilfældigt generet fra gamma-fordeling med middelværdi E[xG] */
      $xG1 = generategamma(3, ExG1/3);
      $xG2 = generategamma(3, ExG2/3);

      /* Beregner for hvert hold tilfældigt antal mål taget fra Poisson-fordeling med middelværdi xG */
      $goals1 = 3; /*generatepoisson($xG1);*/
      $goals2 = generatepoisson($xG2);
    }
    /* Method der opdaterer strength array efter en match */ 
    function update_strength($match)
    {
      $strength = array(1.0, 0.5);
    } 

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }
  function set_color($color) {
    $this->color = $color;
  }
  function get_color() {
    return $this->color;
  }
}

$apple = new Fruit();
$apple->set_name('Apple');
$apple->set_color('Red');
echo "Name: " . $apple->get_name();
echo "<br>";
echo "Color: " . $apple->get_color();
?>
