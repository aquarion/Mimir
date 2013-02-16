<?php
/**
 * Description of journal
 *
 * @author Nicholas
 */
class Journal extends My_Model {
    //put your code here

    public static $_table = 'journal';
    
    
    public function validate_title($value){
        return $this->_validate_required("Name", $value);
    }
    public function validate_description($value){
        return $this->_validate_required("Description", $value);
    }
    public function validate_journal_type($value){
        return $this->_validate_required("Type", $value);
    }
    
    public function journal_type_options(){
        // You can't change these without also changing the database enum.
        return array(
            'Deity' => 'Deity',
            'NPC' => 'NPC',
            'Player Account' => 'Player Account',
            'Crew Notes' => 'Crew Notes',
            'Other' => 'Other'
        );
    }
    
    public function posts() {
        return $this->has_many('Entry'); // Note we use the model name literally - not a pluralised version
    }
}

?>
