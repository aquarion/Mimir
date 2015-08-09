<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entry
 *
 * @author Nicholas
 */
class Player extends My_Model {

	function blessings($printable = true){

        $blessings_cxn = Model::factory('Blessing');
        $blessings_cxn->where('event_id', Event::current())
            ->where("pid", $pid),
            ->where("character_name", $character);

        $blessings = $blessings_cxn->order_by_asc("date_created")->find_many();

        if(!$printable){
        	return $blessings;
        }

        $printable = array();
        foreach($blessings as $id => $blessing){
        	if($blessing->can_be_printed()){
        		$printable[] = $blessing;
        	}
        }

        return $printable;

	}

}

