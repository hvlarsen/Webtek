<?php
  class team
  {
    public $name;
    public $attack, $defense;
    // private $conn;

    
    /* contrutor funktion, der sætter name og strength */
    function __construct($name, $conn)
    {
      $this->conn = $conn;
      $this->name = $name;
      // $this->strength = array($attack, $defense);
    }

    /* Funktion, der loader team strength fra databasen */   
    function load_strength($conn)
    {
      $sql_query = "SELECT AttackPower, DefensePower FROM team_strength where team= '" . $this->name . "';";
      // echo $sql_query;
      $result = $conn->query($sql_query);
      while ($row = $result->fetch_assoc())
      {
        $this->attack  = htmlspecialchars($row['AttackPower']);
        $this->defense = htmlspecialchars($row['DefensePower']);
      }
    }

    /* Funktion, der returnerer team attack */   
    function get_attack()
    {
      return $this->attack;
    }

    /* Funktion, der returnerer team attack */   
    function get_defense()
    {
      return $this->defense;
    }

    /* Method der opdaterer strength array efter en match */ 
    function update_strength($match)
    {
      $strength = array(1.0,0.5);
    } 
  }
?>