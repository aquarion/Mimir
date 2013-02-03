<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of edit
 *
 * @author Nicholas
 */
class Edit {
    
    function __call($name, $arguments){
        
        $thing = Model::factory($name);
        
        $table = $thing->describe_table();
        $item = $thing->find_one($arguments[0]);
        var_dump($table);        

        echo $name;
        return;
        
    }
    
}

?>
