<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author Nicholas
 */
class Auth extends My_Controller {
    function set_event($n){
        Event::set_current($n[0]);
        return $this->_redirect($_SERVER['HTTP_REFERER']);
    }
}

?>
