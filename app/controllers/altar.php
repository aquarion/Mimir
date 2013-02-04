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
        $this->data['gnav_active'] = "altar";
        $this->data['lnav_active'] = "recent";
        
        if(count($_GET)){  
            $title = array();          
            $kudos = Model::factory('Kudos');
            
            $this->data['query_data'] = array();
            
            foreach($_GET as $index => $value){
                $name = ucwords(strtr($index, "_", " "));
                $kudos->where($index, $value);
                $theitle = "$name is $value";
                $title[] = "$name is $value";
                $this->data['query_data'][$theitle] = $index.'='.$value;
            }
            $this->data['recent'] = $kudos->find_many();
            
            if(count($title) > 1){
                $end = array_pop($title);
                $this->data['page_title'] = "Sacrifices where ".implode(", ", $title)." & ".$end;
            } else {
                $this->data['page_title'] = "Sacrifices where ".array_pop($title);
            }
            
        } else {
            $this->data['recent'] = Kudos::recent();
        }
        $this->render("altar/recent");
    }
    
    function add(){
        $this->data['gnav_active'] = "altar";
        $this->data['lnav_active'] = "add";
        
        $this->render("altar/add");
    }
    
    function stats($arguments){
        $this->data['gnav_active'] = "altar";
        $this->data['lnav_active'] = "stats";
        
        $totals = Model::factory("Kudos")->raw_query("select nation, sum(total) as totalize from Kudos group by nation")->find_many();
        $this->data['totals'] = $totals;
              
        
        $this->render("altar/stats");
    }
}

?>
