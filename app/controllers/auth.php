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

    function init(){
	return true;
    }

    function set_event($n){
        Event::set_current($n[0]);
        return $this->_redirect($_SERVER['HTTP_REFERER']);
    }

    function login(){

        if(isset($_POST['redirect'])){
            $this->data['redirect'] = $_POST['redirect'];
        }
        if(isset($_GET['redirect'])){
            $this->data['redirect'] = $_GET['redirect'];
        }

    	if(isset($_POST['password'])){
    		$config = Config::getInstance();
    		if($_POST['password'] == $config->get("system", "password")){
    			$_SESSION['authentication'] = true;
    			$this->_redirect($_POST['redirect']);
    			return;
    		} else {
    			$this->data['error'] = "Sorry, that wasn't correct";
    		}
    	}
    	$this->render("auth/login");
    }

    function logout(){
        if(isset($_SESSION['authentication'])){
            unset($_SESSION['authentication']);
        }
        $this->_redirect("/");
    }
}

?>
