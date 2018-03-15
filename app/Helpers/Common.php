<?php

    /**
    * find the % of  to number 
    *
    * @param $x
    * @param $total
    */

    function percentage($total, $x){

        if($total == 0){
            return 0;
        }else {
            $val = ($x * 100)/$total;
            return round( $val, 1, PHP_ROUND_HALF_UP);
        }
    }

