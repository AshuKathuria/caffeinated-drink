<?php

class Helper {
    
    protected $solutions; 
        
    /**
     * @param Array $candidates
     * @param Integer $target
     * @return Array
     */
    function getAllPossibleCombinations($candidates, $target) {
        $this->solutions = array();
        $this->findCombination($candidates, 0 , $target, 0, array());
        
        return $this->solutions;
    }

    
     /**
     * @param Array $candidates 
     * @param Integer $sum  one solution sum 
     * @param Integer $target 
     * @param Integer $index  
     * @return Array $solution one solution set
     */
    function findCombination($candidates, $sum, $target, $index, $solution) {

        if ($sum > $target) {
            return;
        } else if ($sum == $target) {
            array_push($this->solutions, $solution);
        } else {
            if ($candidates[$index]['caffeine'] > $target-$sum) {
                if (!empty($solution))
                    array_push($this->solutions, $solution);
            }
            
            for ($i = $index; $i < count($candidates); $i++) {

                if ($sum+$candidates[$i]['caffeine'] <= $target) {
                    array_push($solution, $candidates[$i]);
                    $this->findCombination($candidates, ($sum + $candidates[$i]['caffeine']), $target, $i, $solution);

                    array_pop($solution);
                }
            }
        }
    }
}
