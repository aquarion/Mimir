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
            'deity' => 'Deity',
            'npc' => 'NPC',
            'player-account' => 'Player Account',
            'player-letter' => 'Player Letters',
            'crew-notes' => 'Crew Notes',
            'quest' => 'Quests',
            'other' => 'Other'
        );
    }
    
    public function journal_type_title($type){
        $options = $this->journal_type_options();
        return $options[$type];
    }
    
    public function unread_by_type($type){
        $sql = "Select sum(unread_by_story) as summary from entry, journal where journal.id = entry.journal_id and journal.journal_type = :type and event = :event";
        $params = array("type" => $type, 'event' => Event::current());
        $totals =  Model::factory('Journal')->raw_query($sql, $params)->find_one();
        $unread = $totals->summary;
        return $unread ? $unread : '';
    }
    
    public function unread_by_journal($journal){
        $sql = "Select sum(unread_by_story) as summary from entry where journal_id = :journal and event = :event";
        $params = array("journal" => $journal, 'event' => Event::current());
        $totals =  Model::factory('Journal')->raw_query($sql, $params)->find_one();
        $unread = $totals->summary;
        return $unread ? $unread : '';
    }
    
    public function entry_count(){
        $sql = "Select count(*) summary from entry where journal_id = :journal and event = :event";
        $params = array("journal" => $this->id, 'event' => Event::current());
        $totals =  Model::factory('Journal')->raw_query($sql, $params)->find_one();
        $unread = $totals->summary;
        return $unread ? $unread : 0;
    }
    
    public function posts() {
        return $this->has_many('Entry'); // Note we use the model name literally - not a pluralised version
    }
}

?>
