<?php

class Journals extends My_Controller {
    function index(){
        $this->data['gnav_active'] = "journals";
        $this->data['lnav_active'] = "journals";
                
        $this->data['journals'] = Model::factory('Journal');
        $this->data['journal']  = Model::factory('Journal')->create();
        $this->render("journal/index");
    }
    
    function add(){
        $this->data['gnav_active'] = "journals";
        $this->data['lnav_active'] = "add";
        
        $journal = Model::factory('Journal')->create();
        
	if(count($_POST)){
            foreach($_POST as $index => $value){
                    // Todo: Error Checking
                    $journal->$index = $value;
            }

            $validate = $journal->validate();

            if ($validate === true){
                $journal->save();
                return $this->_redirect(sprintf("/journals/journal/%s", $journal->id));
            } else {
                $this->data['errors'] = $validate;
            }

	} 
        $this->data['journal'] = $journal;
       
        $this->render("journal/add");
    }
    
    function journal($id){
        
        $this->data['gnav_active'] = "journals";
        $this->data['lnav_active'] = "journals";
        
        $journals = Model::factory("Journal");
        $journal = $journals->find_one($id);
        
        $this->data['journal'] = $journal;
        
        
        $this->render("journal/view");
    }
    
    function add_entry($id){
        
        $this->data['gnav_active'] = "journals";
        $this->data['lnav_active'] = "journals";
        
        $journals = Model::factory("Journal");
        $journal = $journals->find_one($id);
               
                
        $entry = Model::factory('Entry')->create();
        $entry->event        = Event::current();
        $entry->date_created = date(DATETIME_MYSQL);
        
        $this->data['journal']     = $journal;
        $this->data['entry']       = $entry;
        
	if(count($_POST)){
            foreach($_POST as $index => $value){
                    // Todo: Error Checking
                    $entry->$index = $value;
            }

            $validate = $entry->validate();

            if ($validate === true){
                $entry->save();
                #return $this->_redirect(sprintf("/journals/journal/%s", $journal->id));
                return $this->_redirect(sprintf("/journals/journal/%s#post-%s", $journal->id, $entry->id));
            } else {
                $this->data['errors'] = $validate;
            }

	} 
        
        $this->render("journal/add_entry");
    }
}