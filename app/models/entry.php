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
class Entry extends My_Model{
    public function journal() {
        return $this->belongs_to('Journal');
    }
    
    public function validate_title($value){
        return $this->_validate_required("Title", $value);
    }
    public function validate_content($value){
        return $this->_validate_required("Content", $value);
    }
    public function validate_physrep($value){
        return $this->_validate_required("Physrep", $value);
    }
    public function validate_author($value){
        return $this->_validate_required("Author", $value);
    }
    public function validate_event($value){
        return $this->_validate_numeric("Event", $value);
    }
    public function validate_journal_id($value){
        return $this->_validate_numeric("Journal", $value);
    }
    
    
}

?>
