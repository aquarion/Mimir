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
    
    public function validate_event_id($value){
        return $this->_validate_numeric("Event", $value);
    }
    public function validate_sacrifice_type($value){
        return $this->_validate_required("Type", $value);
    }
    
    public function validate_priest_id($value){
        return $this->_validate_numeric("Priest PID", $value);
    }
    public function validate_priest_name($value){
        return $this->_validate_required("Priest's Name", $value);
    }
    public function validate_group_name($value){
        return $this->_validate_required("Group", $value);
    }
    public function validate_nation($value){
        // Todo 
        return $this->_validate_required("Nation", $value);
    }
    public function validate_deity($value){
        return $this->_validate_required("Deity", $value);
    }
    public function validate_lives($value){
        return $this->_validate_numeric("Lives", $value);
    }
    public function validate_life_bonus($value){
        return $this->_validate_numeric("Life Bonus", $value);
    }
    public function validate_arena_bonus($value){
        return $this->_validate_numeric("Arena Bonus", $value);
    }
    public function validate_chalkoi($value){
        return $this->_validate_numeric("Chalkoi", $value);
    }
    public function validate_obol($value){
        return $this->_validate_numeric("Obol", $value);
    }
    public function validate_drachma($value){
        return $this->_validate_numeric("Drachma", $value);
    }
    public function validate_pentadrachma($value){
        return $this->_validate_numeric("Pentadrachma", $value);
    }
    public function validate_mina($value){
        return $this->_validate_numeric("Mina", $value);
    }
    public function validate_quin_earth($value){
        return $this->_validate_numeric("Earth Quin", $value);
    }
    public function validate_quin_air($value){
        return $this->_validate_numeric("Air Quin", $value);
    }
    public function validate_quin_fire($value){
        return $this->_validate_numeric("Fire Quin", $value);
    }
    public function validate_quin_water($value){
        return $this->_validate_numeric("Water Quin", $value);
    }
    public function validate_total($value){
        return $this->_validate_numeric("Total", $value);
    }
    //public function validate_notes($value){
    //}
}

?>
