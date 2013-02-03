<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kudos
 *
 * @author Nicholas
 */
class Kudos extends Model {
    //put your code here
    
    static function recent($count=100, $page=1){
        
        $offset = ($page-1) * $count;
        
        $kudos = Model::factory('Kudos')
            ->limit($count)
            ->offset($offset)
            ->find_many();
        
            
        return $kudos;
        
    }
}

?>
