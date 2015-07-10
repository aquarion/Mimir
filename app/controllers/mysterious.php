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

    function add(){
        return $this->editForm();
    }

    function edit($arguments){
        return $this->editForm($arguments[0]);
    }

    function view($arguments){
        $this->data['gnav_active'] = "mysterious";
        $this->data['lnav_active'] = "index";
        $mystery_cxn = Model::factory('GreaterMystery');
        $cast_cxn = Model::factory('GMCast');

        $mystery = $mystery_cxn->find_one($arguments[0]);
        $cast = $cast_cxn->where("mystery_id", $arguments[0]);
        $this->data['cast'] = $cast->order_by_asc("date_cast")->find_many();
        $this->data['mystery'] = $mystery;
        $this->render("mysterious/view");
    }

    function editForm($id = null) {
        $this->data['gnav_active'] = "mysterious";
        $this->data['lnav_active'] = "add";
        
        $mystery_cxn = Model::factory('GreaterMystery');

        if($id){
            $mystery = $mystery_cxn->find_one($id);
        } else {
            $mystery =$mystery_cxn->create();
        }
        
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


    public function import(){
        if(isset($_FILES['import'])){

            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['import']['error']) ||
                is_array($_FILES['import']['error'])
            ) {
                die('Invalid parameters.');
            }

            // Check $_FILES['import']['error'] value.
            switch ($_FILES['import']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    die('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    die('Exceeded filesize limit.');
                default:
                    die('Unknown errors.');
            }
            $this->importMysteries($_FILES['import']['tmp_name']);

        } else {
            $this->data['gnav_active'] = "mysterious";
            $this->data['lnav_active'] = "import";

            $this->render("mysterious/import_form");

        }
    }

    private function importMysteries($filename, $event_id = 9){

            require('../lib/XLSXReader/XLSXReader.php');
            $xlsx = new XLSXReader($filename);
            $sheets = $xlsx->getSheetNames();

            $mystery_cxn = Model::factory('GreaterMystery');

            /*   
             0  => string 'Code' (length=17)
             1  => string 'Greater mysteries' (length=17)
             2  => string 'Focus' (length=8)
             3  => string 'Short Effect Line' (length=17)
             4  => string 'Flavour Text' (length=12)
             5  => string 'Type' (length=4)
             6  => string 'Culture?' (length=8)
             7  => string 'Coin' (length=4)
             8  => string 'Prime' (length=5)
             9  => string 'F' (length=1)
             10 => string 'E' (length=1)
             11 => string 'A' (length=1)
             12 => string 'W' (length=1)
             13 => string 'Blood' (length=5)
             14 => string 'Cost' (length=4)
             15 => string 'Duration' (length=8)
             16 => string 'Source' (length=6)
             17 => string 'Game effects' (length=12)
              */


            //$sheets = array(array_pop($sheets));
            foreach($sheets as $sheet){
                if($sheet == "Tribute distribution"){
                    continue;
                }
                $mysteries = $xlsx->getSheetData($sheet);
                echo "<h2>$sheet</h2>";
                foreach($mysteries as $i => $mystery){
                    if($i == 0 || !$mystery[1]){
                        continue;
                    }

                    $newmystery = $mystery_cxn->create();
                    $newmystery->event_id = Event::current();
                    $newmystery->sign_requirement = Event::current_attribute('sign');
                    $newmystery->set = $sheet;
                    $newmystery->date_created = date(DATETIME_MYSQL);
                    $newmystery->name = $mystery[1];
                    $newmystery->mystery_type = $mystery[4];
                    $newmystery->aquisition_type = $mystery[16];
                    $newmystery->effect_type  = $mystery[5];
                    $newmystery->culture = $mystery[6];
                    $newmystery->prime = $mystery[8];
                    $newmystery->drachma = $mystery[7];
                    $newmystery->quin_earth = $mystery[10];
                    $newmystery->quin_air = $mystery[11];
                    $newmystery->quin_fire = $mystery[9];
                    $newmystery->quin_water = $mystery[12];
                    $newmystery->blood = $mystery[13];
                    $newmystery->short_desc = $mystery[3];
                    $newmystery->flavour = $mystery[4];
                    $newmystery->duration = $mystery[15];
                    $newmystery->effect = $mystery[17];
                    $newmystery->code = $mystery[0];

                    $newmystery->save();
                    echo '<pre>';
                    var_dump($newmystery->as_array());
                    echo '</pre>';




                    
                }
            }

            //header("Location: /mysterious");

    }

    function cast($arguments = false){
        $this->data['gnav_active'] = "mysterious";
        $this->data['lnav_active'] = "castings";
        $cast_cxn = Model::factory('GMCast');
        $cast_cxn->where('event_id', Event::current());
        
        if(!$arguments){
            $this->data['casts'] = $cast_cxn->order_by_asc("date_cast")->find_many();
            foreach($this->data['casts'] as $index => &$cast){
                $mystery_cxn = Model::factory('GreaterMystery');
                $cast->mystery = $mystery_cxn->find_one($cast->mystery_id);
            }

            $this->render("mysterious/cast_list");
            return;
        }
        if (count($_POST)) {
            $cast = $cast_cxn->create(); 

            unset($_POST['posted']);
            foreach ($_POST as $index => $value) {
                $cast->$index = $value;
            }
            
            $cast->date_cast = date(DATETIME_MYSQL);
            $cast->mystery_id = $arguments[0];

            $validate = $cast->validate();

            if ($validate === true) {
                $cast->save();
                return $this->_redirect("/mysterious/cast");
            } else {
                $this->data['errors'] = $validate;
            }
        }

        $mystery_cxn = Model::factory('GreaterMystery');
        $mystery = $mystery_cxn->find_one($arguments[0]);
        $this->data['mystery'] = $mystery;
        $this->render("mysterious/cast");
    }


}
