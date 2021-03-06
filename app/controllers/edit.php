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
class Edit extends My_Controller {
    
    function __call($name, $arguments){
        
        $thing = Model::factory($name);
        
        $sql = 'describe '.$name;
        $table = Model::factory($name)->raw_query($sql)->find_many();
        
        $item = $thing->find_one($arguments[0]);
            
    	if(count($_POST)){

    		#print_r($_POST);
    		$kudos = Model::factory($name)->create();
    		foreach($_POST as $index => $value){
    			// Todo: Error Checking
    			$item->$index = $value;
    		}
    		$item->save();
    		$this->data['success'] = "Save successful";
    	} 
           
            
        
        $schema = array();
        foreach($table as $row){
            $row = $row->as_array();
            
            if(stristr($row['Type'], "int") !== FALSE ){
                $row['input'] = "number";
            } elseif(stristr($row['Type'], "text") !== FALSE && $row['Type'] != "tinytext"){
                $row['input'] = "textarea";
            } else {
                $row['input'] = "text";
            }
            $schema[$row['Field']] = $row;
        }
        
        $this->data['schema'] = $schema;
        $this->data['item']   = $item;
        $this->data['name']   = $name;

        $this->render("edit");
    }
    
}

?>
