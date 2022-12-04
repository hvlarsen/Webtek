<?php
  class team
  {
    public $name;
    private $attack, $defense;
      
    /* contrutor funktion, der sætter name og strength */
    function __construct($name, $conn)
    {
      $this->conn = $conn;
      $this->name = $name;
    }

    /* Funktion, der loader team strength fra databasen */   
    function load_strength($conn)
    {
      $sql_query = "SELECT AttackPower, DefensePower 
                    FROM team_strength 
                    WHERE team = '" . $this->name . "';";
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

    /* Method der opdaterer attack of defense efter en match. */
    /* TODO: Lav team_strength tabel der indeholder den opdaterede strength for hver simulationID */ 
    function update_strength($match)
    {
      /* TODO: Opdater $attack og $defense på baggrund af kampens udfald */ 
    } 
  }
?>