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
class Artifacts extends My_Controller {
   
    function index(){
        $this->data['gnav_active'] = "artifacts";
        $this->data['lnav_active'] = "index";

        $artifact = Model::factory('artifact');
        #$artifact->where('event_id', Event::current());

        if (count($_GET)) {
            $title = array();

            $this->data['query_data'] = array();

            foreach ($_GET as $index => $value) {
                $name = ucwords(strtr($index, "_", " "));
                $artifact->where($index, $value);
                $theitle = "$name is $value";
                $title[] = "$name is $value";
                $this->data['query_data'][$theitle] = $index . '=' . $value;
            }
            $this->data['recent'] = $artifact->order_by_asc("date_created")->find_many();

            if (count($title) > 1) {
                $end = array_pop($title);
                $this->data['page_title'] = "Artifacts where " . implode(", ", $title) . " & " . $end;
            } else {
                $this->data['page_title'] = "Artifacts where " . array_pop($title);
            }
        } else {
            $this->data['recent'] = $artifact->order_by_asc("name")->find_many();
        }
        $this->render("artifacts/index");
    }

    function add(){
        return $this->editForm();
    }

    function edit($arguments){
        return $this->editForm($arguments[0]);
    }

    function view($arguments){
        $this->data['gnav_active'] = "artifacts";
        $this->data['lnav_active'] = "index";
        $artifact_cxn = Model::factory('Artifact');
        $artifact = $artifact_cxn->find_one($arguments[0]);
        $this->data['artifact'] = $artifact;
        $this->render("artifacts/view");
    }

    function editForm($id = null) {
        $this->data['gnav_active'] = "artifacts";
        $this->data['lnav_active'] = "add";
        
        $artifact_cxn = Model::factory('Artifact');

        if($id){
            $artifact = $artifact_cxn->find_one($id);
        } else {
            $artifact =$artifact_cxn->create();
        }
        
        $artifact->event_id = Event::current();

		$artifact->date_created = date(DATETIME_MYSQL);

        if (count($_POST)) {
            foreach ($_POST as $index => $value) {
                $artifact->$index = $value;
            }
            
            $validate = $artifact->validate();

            if ($validate === true) {
                $artifact->save();
                return $this->_redirect("/artifacts/");
            } else {
                $this->data['errors'] = $validate;
            }
        }
        
        $this->data['artifact'] = $artifact;

        $this->render("artifacts/add");
    }

}

?>
