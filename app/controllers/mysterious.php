<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of blesser
 *
 * @author Nicholas
 */
class Mysterious extends My_Controller {
   
    function index(){
        $this->data['gnav_active'] = "mysterious";
        $this->data['lnav_active'] = "index";

        $mystery = Model::factory('GreaterMystery');
        $mystery->where('event_id', Event::current());

        if (count($_GET)) {
            $title = array();

            $this->data['query_data'] = array();

            foreach ($_GET as $index => $value) {
                $name = ucwords(strtr($index, "_", " "));
                $mystery->where($index, $value);
                $theitle = "$name is $value";
                $title[] = "$name is $value";
                $this->data['query_data'][$theitle] = $index . '=' . $value;
            }
            $this->data['recent'] = $mystery->order_by_asc("date_created")->find_many();

            if (count($title) > 1) {
                $end = array_pop($title);
                $this->data['page_title'] = "Mysteries where " . implode(", ", $title) . " & " . $end;
            } else {
                $this->data['page_title'] = "Mysteries where " . array_pop($title);
            }
        } else {
            $this->data['recent'] = $mystery->order_by_asc("name")->find_many();
        }
        $this->render("mysterious/index");
    }


    function add() {
        $this->data['gnav_active'] = "mysterious";
        $this->data['lnav_active'] = "add";
        
        $mystery = Model::factory('GreaterMystery')->create();
        
        $mystery->event_id = Event::current();

        $mystery->sign_requirement = Event::current_attribute('sign');
		$mystery->date_created = date(DATETIME_MYSQL);

        if (count($_POST)) {
            foreach ($_POST as $index => $value) {
                $mystery->$index = $value;
            }
            
            $validate = $mystery->validate();

            if ($validate === true) {
                $mystery->save();
                return $this->_redirect("/mysterious/");
            } else {
                $this->data['errors'] = $validate;
            }
        }
        
        $this->data['mystery'] = $mystery;

        $this->render("mysterious/add");
    }

}

?>
