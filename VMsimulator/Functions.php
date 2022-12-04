<?php
/* Diverse generiske funktioner, der skal anvendes */

    /* Funktion, der genererer en gammafordelt stokastisk variabel med parametre a,b */ 
    function generategamma(int $a,$b) {
    $x = 1;
    $L = 0;  
    while ($x<=$a){
        $L += -log(1-rand(1,9999)/10000); 
        $x++;
    }
    return $L/$b;
    }

    /* Funktion, der genererer en Poissinfordelt stokastisk variabel med parameter lambda */
    function generatepoisson($lambda){
        $x = 0;
        $L = -log(1-rand(1,9999)/10000);
        while ($L <= $lambda){
            $x++;
            $L += -log(1-rand(1,9999)/10000);
        } 
        return $x;
    }
?>

