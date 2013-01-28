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
        $this->render("altar/recent");
    }
    
    function add(){
        $this->render("altar/add");
    }
}

?>
