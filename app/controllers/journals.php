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
    
    function attention(){
        
        $this->data['gnav_active'] = "journals";
        $this->data['lnav_active'] = "attention";
        
        $this->data['posts'] = $this->fetch_attention()->find_many();
        
        $this->render("journal/attention");
        
    }
    
    function fetch_attention(){
        return Model::factory("Entry")->where("event", Event::current())->where("attention_flag", 1);
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
    
    function ajax($intent){
        $intent = $intent[0];
        $return = array();
        $htmlid = $_POST['id'];
        list($js, $id) = explode("-", $_POST['id'], 2);
        
        $return['id'] = $id;
        $return['htmlid'] = $htmlid;
        
        $entry = Model::factory("Entry")->find_one($id);
        
        if(!$entry){
            $data['error'] = "Could not load that entry";
            echo json_encode($return);      
            return;
        } 
        
        switch ($intent){
            case "markread":
                $return['addevent'] = "markunread";
                $return['removeclass'] = "btn-primary";
                $return['content']  = 'Mark unread';
                $entry->unread_by_story = 0;
                $entry->save();
              
                break;
            
            case "markunread":
                $return['addevent'] = "markread";
                $return['addclass'] = "btn-primary";
                $return['content']  = 'Mark Read by Story';
                $entry->unread_by_story = 1;
                $entry->save();
                break;
            
            case "markflag":
                $return['addevent'] = "markunflag";
                $return['addclass'] = "btn-danger";
                $return['content']  = '<i class="icon-flag icon-white"></i>';
                $entry->attention_flag = 1;
                $entry->save();
                $return['attention'] = $this->_attention_count();
                break;
            
            case "markunflag":
                $return['addevent'] = "markflag";
                $return['removeclass'] = "btn-danger";
                $return['content']  = '<i class="icon-flag"></i>';
                $entry->attention_flag = 0;
                $entry->save();
                $return['attention'] = $this->_attention_count();
                break;
            
            default:
                $return['addevent'] = "wtf? ".$intent;
            
        }
                
        echo json_encode($return);      
        return;
    }
    
    private function _attention_count(){
        $count = Model::factory("Entry")->where("event", Event::current())->where("attention_flag", 1)->count();
        return $count ? $count : '';
    }
    
    function attention_count(){
        echo $this->_attention_count();
        return;
    }

    function search(){
        $search = Model::factory("Entry")->where('event', Event::current());
        $journals = array();

        $this->data['journal'] = false;
        if(isset($_GET['jid']) && is_numeric($_GET['jid'])){
            $jid = $_GET['jid'];
            $search = $search->where('journal_id', $jid);
            $this->data['journal'] = Model::factory("Journal")->where_id_is($jid)->find_one();
            $journals[$jid] = $this->data['journal'];
        }
        $search = $search->where_raw(' MATCH (title, content) AGAINST (?)', $_GET['q']);
        $search = $search->order_by_asc("journal_id");

        $results = $search->find_many();


        foreach($results as $entry){
            $jid = $entry->journal_id;
            if(!isset($journals[$jid])){
                $journals[$jid] = Model::factory("Journal")->where_id_is($jid)->find_one();
            }
        }

        $this->data['journals'] = $journals;
        $this->data['results']  = $results;
        $this->data['search_journal_type'] = false;

        $this->render("journal/search_results");

    }
}