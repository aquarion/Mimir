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
        
        $this->data['recent'] = Kudos::recent();
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
