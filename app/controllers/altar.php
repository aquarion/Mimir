<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of altar
 *
 * @author Nicholas
 */
class Altar extends Controller {
    //put your code here
    
    function index(){
	return $this->kudos_tracker();
    }
    
    function kudos_tracker(){
        $this->data['gnav_active'] = "altar";
        $this->data['lnav_active'] = "recent";
        
        $kudos = Model::factory('Kudos');
        $kudos->where('event_id', Event::current());
        
        if(count($_GET)){  
            $title = array();          
            
            $this->data['query_data'] = array();
            
            foreach($_GET as $index => $value){
                $name = ucwords(strtr($index, "_", " "));
                $kudos->where($index, $value);
                $theitle = "$name is $value";
                $title[] = "$name is $value";
                $this->data['query_data'][$theitle] = $index.'='.$value;
            }
            $this->data['recent'] = $kudos->order_by_asc("date_created")->find_many();
            
            if(count($title) > 1){
                $end = array_pop($title);
                $this->data['page_title'] = "Sacrifices where ".implode(", ", $title)." & ".$end;
            } else {
                $this->data['page_title'] = "Sacrifices where ".array_pop($title);
            }
            
        } else {
            $this->data['recent'] = $kudos->order_by_asc("date_created")->find_many();
        }
        $this->render("altar/recent");
    }
    
    function add(){
        $this->data['gnav_active'] = "altar";
        $this->data['lnav_active'] = "add";

	if(count($_POST)){

		#print_r($_POST);
		$kudos = Model::factory('Kudos')->create();
                $kudos->event_id     = Event::current();
                $kudos->date_created = date(DATETIME_MYSQL);
                
		foreach($_POST as $index => $value){
			// Todo: Error Checking
			$kudos->$index = $value;
		}
		$kudos->save();
		return $this->_redirect("/altar/");
	} 
       
        $this->render("altar/add");
    }
    
    
    function stats($arguments){
        $this->data['gnav_active'] = "altar";
        $this->data['lnav_active'] = "stats";
        
	switch (count($arguments)) {
            case 1:
                return $this->_nation_stats($arguments[0]);
                break;
            case 3:
                list($nation, $type, $identifier) = $arguments;
                if($type == "group"){
                    return $this->_group_stats($nation, $identifier);
                } elseif($type == "deity"){
                    return $this->_deity_stats($nation, $identifier);
                } elseif($type == "priest"){
                    return $this->_priest_stats($nation, $identifier);
                }
                throw new Exception_FourOhFour("What is a ".$type);
            case 0:
            default:
                return $this->_global_stats();
		    
	}
    }
    
    private function _nation_title($nation){
        
        $titles = array(
            'carthage' => 'The Dominion of Carthage',
            'egypt' => 'The Kingdom of Egypt',
            'greece' => 'The Free Greek City-States',
            'hellasphoenicia' => 'Hellas Phoenicia',
            'rome' => 'The Republic of Rome',
            'persia' => 'The Persian Empire'
        );
        
        return $titles[$nation];
    }
    private function _nation_name($nation){
        $titles = array(
            'carthage' => 'Carthage',
            'egypt' => 'Egypt',
            'greece' => 'Greece',
            'hellasphoenicia' => 'Hellas Phoenicia',
            'rome' => 'Rome',
            'persia' => 'Persia'
        );
        
        return $titles[$nation];
        
    }
    
    private function _global_stats(){
        
        $totals = Model::factory("Kudos")->raw_query("select nation, sum(total) as totalize from kudos group by nation")->find_many();
        $this->data['totals'] = $totals;
        
        $this->render("altar/stats");
    }
    
    private function _nation_stats($nation){
        
        $this->data['nation'] = $nation;
        
        $this->data['title'] = $this->_nation_title($nation);
        $this->data['capnation'] = $this->_nation_name($nation);
        
        $params = array('nation' => $nation, 'event' => Event::current());
        
        $sql = 'select group_name, sum(total) as totalize from kudos 
            where nation = :nation and event_id = :event
            group by lcase(group_name) order by totalize desc';
        $this->data['groups'] = Model::factory("Kudos")->raw_query($sql, $params)->find_many();
        
        $sql = 'select priest_id, priest_name, sum(total) as totalize 
            from kudos where nation = :nation and event_id = :event
            group by priest_name order by totalize desc';
        $this->data['priests'] = Model::factory("Kudos")->raw_query($sql, $params)->find_many();
        
        $sql = 'select deity, sum(total) as totalize from kudos 
            where nation = :nation and event_id = :event
            group by deity order by totalize desc';
        $this->data['deities'] = Model::factory("Kudos")->raw_query($sql, $params)->find_many();
                
        $this->render("altar/nation_stats");
    }
    
    
    private function _group_stats($nation, $group_name){
        
        $group_name = urldecode($group_name);
        
        $this->data['nation'] = $nation;
        $this->data['group']  = $group_name;
        
        $this->data['capnation'] = $this->_nation_name($nation);
        
        $params = array('nation' => $nation, 'event' => Event::current(), 'group' => $group_name);
        
        $sql = 'select priest_id, priest_name, sum(total) as totalize 
            from kudos where nation = :nation and group_name = :group and event_id = :event
            group by priest_name order by totalize desc';
        $this->data['priests'] = Model::factory("Kudos")->raw_query($sql, $params)->find_many();
        
        $sql = 'select deity, sum(total) as totalize from kudos 
            where nation = :nation and group_name = :group and event_id = :event
            group by deity order by totalize desc';
        $this->data['deities'] = Model::factory("Kudos")->raw_query($sql, $params)->find_many();
                
        $this->render("altar/group_stats");
    }
    
    private function _deity_stats($nation, $deity){
        
        $deity = urldecode($deity);
        
        $this->data['nation']    = $nation;
        $this->data['deity']     = $deity;
        $this->data['title']     = $this->_nation_title($nation);
        $this->data['capnation'] = $this->_nation_name($nation);
        
        $params = array('deity' => $deity, 'event' => Event::current());
        
        $sql = 'select group_name, nation, sum(total) as totalize from kudos 
            where deity = :deity and event_id = :event
            group by lcase(group_name) order by totalize desc';
        $this->data['groups'] = Model::factory("Kudos")->raw_query($sql, $params)->find_many();
        
        $sql = 'select priest_id, priest_name, nation, sum(total) as totalize 
            from kudos where deity = :deity and event_id = :event
            group by priest_name order by totalize desc';
        $this->data['priests'] = Model::factory("Kudos")->raw_query($sql, $params)->find_many();
        
                
        $this->render("altar/deity_stats");
    }
    
    private function _priest_stats($nation, $priest_name){
        
        $priest_name = urldecode($priest_name);
        
        $this->data['nation']      = $nation;
        $this->data['title']       = $this->_nation_title($nation);
        $this->data['capnation']   = $this->_nation_name($nation);
        $this->data['priest_name'] = $priest_name;
        
        $params = array('priest' => $priest_name);
        
        $sql = 'select deity, sum(total) as totalize from kudos 
            where priest_name = :priest
            group by deity order by totalize desc';
        $this->data['deities'] = Model::factory("Kudos")->raw_query($sql, $params)->find_many();
        
        $this->render("altar/priest_stats");
    }
    
}

?>
