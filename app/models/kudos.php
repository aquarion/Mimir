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
class Kudos extends My_Model {
    //put your code here

    public static $_table = 'kudos';
    
    static function recent($count=100, $page=1){
        
        $offset = ($page-1) * $count;
        
        $kudos = Model::factory('Kudos')
            ->where("event_id", Event::current())
            ->find_many();
            #->limit($count)
            #->offset($offset)
        
            
        return $kudos;
        
    }
}

?>
