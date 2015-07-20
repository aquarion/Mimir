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
class Blesser extends My_Controller {

    function index(){
        $this->render("blesser/pick_nation");

    }

    function create(){

        $this->data['gnav_active'] = "blesser";
        $this->data['lnav_active'] = "add";
        
        $blessing_factory = Model::factory('Blessing');
        

        if(isset($_REQUEST['id'])){
            $blessing = $blessing_factory->find_one($_REQUEST['id']);
        } else {
            $blessing = $blessing_factory->create();
            $blessing->event_id = Event::current();
            $blessing->date_created = date(DATETIME_MYSQL);
        }
        

        if (count($_POST)) {
            foreach ($_POST as $index => $value) {
                if(in_array($index, array('token_count', 'token_effect', 'token_target'))){
                    continue;
                }
                $blessing->$index = $value;
            }
            $token = array();
            for ($i=1; $i <= 4; $i++) { 
                $token[$i]['effect'] = $_POST['token_effect'][$i];
                $token[$i]['count']  = $_POST['token_count'][$i];
                $token[$i]['target'] = $_POST['token_target'][$i];
            }

            $blessing->tokens = json_encode($token);

            $validate = $blessing->validate();

            if ($validate === true) {
                $blessing->date_edited = date(DATETIME_MYSQL);
                $blessing->review_plot = null;
                $blessing->review_ref = null;
                $blessing->review_sane = null;
                $blessing->save();
                return $this->_redirect("/blesser/review");
            } else {
                $this->data['errors'] = $validate;
            }
        }
        $this->data['blessing'] = $blessing;

        $this->render("blesser/create");
    }

    function review(){

        $blessings = Model::factory('Blessing');
        $blessings->where('event_id', Event::current());

        $dataset = $blessings->order_by_asc("date_created")->find_many();

        $blessingslist = array();

        foreach($dataset as $blessing){
            if ( !$blessing->is_reviewed() ){
                $blessingslist[] = $blessing;
            }
        }
        $this->data['blessings'] = $blessingslist;
        $this->data['gnav_active'] = "blesser";
        $this->data['lnav_active'] = "review";

        $this->render("blesser/review");
    }

    function all(){

        $blessings = Model::factory('Blessing');
        $blessings->where('event_id', Event::current());

        $blessingslist = $blessings->order_by_asc("date_created")->find_many();

        $this->data['blessings'] = $blessingslist;

        $this->render("blesser/review");
    }

    function player(){
        $this->render("blesser/player");
    }

    function nation_by_character(){
        $this->render("blesser/nation_by_character");
    }

    function nation_by_god(){
        $this->render("blesser/nation_by_character");
    }


    function ajax($intent){
        $intent = $intent[0];
        $return = array();
        $htmlid = $_POST['id'];
        $cat    = $_POST['cat'];
        list($js, $id) = explode("-", $_POST['id'], 2);
        
        $return['id'] = $id;
        $return['htmlid'] = $htmlid;
        
        $blessing = Model::factory("Blessing")->find_one($id);
        
        if(!$blessing){
            $data['error'] = "Could not load that entry";
            echo json_encode($return);      
            return;
        } 
        
        switch ($intent){
            case "review":
                $return['addevent'] = "unreview";

                if($js == 'refreview'){
                    $return['addclass'] = "btn-primary";
                    $blessing->review_ref = 1;
                } elseif($js == 'plotreview'){
                    $return['addclass'] = "btn-warning";
                    $blessing->review_plot = 1;
                } elseif($js == 'sanityreview'){
                    $return['addclass'] = "btn-inverse";
                    $blessing->review_sane = 1;
                }
                
                $blessing->save();
              
                break;
            
            case "unreview":
                $return['addevent'] = "review";

                if($js == 'refreview'){
                    $return['removeclass'] = "btn-primary";
                    $blessing->review_ref = null;
                } elseif($js == 'plotreview'){
                    $return['removeclass'] = "btn-warning";
                    $blessing->review_plot = null;
                } elseif($js == 'sanityreview'){
                    $return['removeclass'] = "btn-inverse";
                    $blessing->review_sane = null;
                }
                
                $blessing->save();
              
                break;
            
            default:
                $return['addevent'] = "wtf? ".$intent;
            
        }
                
        echo json_encode($return);      
        return;
    }
}

?>
