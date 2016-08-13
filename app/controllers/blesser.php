<?php

/**
 * Description of blesser
 *
 * @author Nicholas
 */
class Blesser extends My_Controller {

    function init(){
        $this->data['gnav_active'] = "blesser";
        return $this->requires_auth();
    }

    function index(){
        $this->data['lnav_active'] = "index";
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
                $blessing->date_printed = null;
                $blessing->save();
                return $this->_redirect(sprintf("/blesser/character/%d:%s", $blessing->target_id, $blessing->target_name));
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

        $dataset = $blessings->order_by_asc("target_name")->find_many();

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



    function deity($arguments){

        if(isset($arguments[0])){
            return $this->for_deity(urldecode($arguments[0]));
        }

        $dataset = Model::factory('Blessing')
            ->where('event_id', Event::current())
            ->group_by('issuer')
            // ->order_by_asc("target_nation")
            ->find_many();


        $issuers = array();
        foreach($dataset as $blessing){
            $blam = explode(":", $blessing->issuer, 2);
            if(count($blam) > 1){
                $issuer = trim($blam[1]);
            } else {
                $issuer = $blam[0];
            }
            $issuers[] = $issuer;
        }

        sort($issuers);
        $issuers = array_unique($issuers);

        $this->data['issuers'] = $issuers;
        $this->data['gnav_active'] = "blesser";
        $this->data['lnav_active'] = "deity";
        $this->render("blesser/deity");

    }

    function for_deity($deity){
        $blessings = Model::factory('Blessing');
        $blessings->where('event_id', Event::current());
        $blessings->where_like('issuer', '%'.$deity.'%');

        $blessingslist = $blessings->order_by_asc("target_name")->find_many();

        $this->data['blessings'] = $blessingslist;
        $this->data['gnav_active'] = "blesser";
        $this->data['lnav_active'] = "deity";

        $this->render("blesser/review");
    }

    function character($user){

        list($pid, $character) = explode(":", $user[0], 2);

	$character = urldecode($character);

        $blessings_cxn = Model::factory('Blessing');
        $blessings_cxn->where('event_id', Event::current())
            ->where("target_id", $pid);

        if($character){
            $blessings_cxn->where("target_name", $character);
        }

        $blessings = $blessings_cxn->order_by_desc("can_print")
		->order_by_asc("date_created")->find_many();

        $this->data['blessings'] = $blessings;
        $this->data['gnav_active'] = "blesser";
        $this->data['lnav_active'] = "character";

        $this->render("blesser/review");
    }



    function namecheck(){
        ORM::configure('logging', true);

        $blessings = Model::factory('Blessing');
        $blessings->where('event_id', Event::current());


        $dataset = $blessings->order_by_asc("target_id")->group_by("target_name")->find_many();

        $blessingslist = array();

        foreach($dataset as $blessing){
            if (!isset($blessingslist[$blessing->target_id])){
                $players = Model::factory('Player');
                $blessingslist[$blessing->target_id]['blessings'] = array();
                $player = $players->where('event_id', Event::current())->where("pid", $blessing->target_id)->find_one();

                $blessingslist[$blessing->target_id]['player'] = $player;
            }
            $blessingslist[$blessing->target_id]["blessings"][] = $blessing;
        }

        $this->data['players'] = $blessingslist;
        $this->data['gnav_active'] = "blesser";
        $this->data['lnav_active'] = "namecheck";

        $this->render("blesser/namecheck");
    }

    function printqueue(){

        $blessings = Model::factory('Blessing');
        $blessings->where('event_id', Event::current());

        $dataset = $blessings->order_by_asc("target_name")->find_many();

        $blessingslist = array();

        foreach($dataset as $blessing){
            if ($blessing->is_reviewed() && !$blessing->is_printed() && $blessing->can_print ){
                $blessingslist[] = $blessing;
            }
        }
        $this->data['blessings'] = $blessingslist;
        $this->data['gnav_active'] = "blesser";
        $this->data['lnav_active'] = "print";

        $this->render("blesser/review");
    }

    function printpdf(){

        if(!isset($_POST['print'])){
            die('No');
        }

        $people = explode("%%", $_POST['print']);

        $characters = array();

        foreach($people as $user){
            list($pid, $character) = explode(":", $user, 2);

            $blessings_cxn = Model::factory('Blessing');
            $blessings_cxn->where('event_id', Event::current())
                ->where("target_id", $pid)
                ->where("target_name", $character);

            $blessings = $blessings_cxn->order_by_asc("date_created")->find_many();

            $blessingslist = array();
            foreach($blessings as $blessing){
                if($blessing->allow_print()){
                    $blessingslist[] = $blessing;
                }
            }

            if(count($blessingslist)){   
                $characters[$user] = array(
                    'name'      => $character,
                    'pid'       => $pid,
                    'blessings' => $blessingslist
                );
            }

        }

        $this->data['characters'] = $characters;
        $this->data['gnav_active'] = "blesser";
        $this->data['lnav_active'] = "print";

        $this->renderAlone("blesser/print_pdf");

    }

    function x000D(){

        $this->data['lnav_active'] = "all";
        $blessings = Model::factory('Blessing');
        $blessings->where('event_id', Event::current());

        $blessingslist = $blessings->order_by_asc("date_created")->find_many();


	foreach($blessingslist as $blessing){
		if(strpos($blessing->effect, "_x000D_") === FALSE){
			continue;
		}
		print nl2br(str_replace("_x000D_", "", $blessing->effect));
		print "<hr/>";
		print nl2br($blessing->effect);
		print "<hr/>";
		print "<hr/>";
		$blessing->effect = str_replace("_x000D_", "", $blessing->effect);
		$blessing->save();
	}

    }

    function all(){

        $this->data['lnav_active'] = "all";
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
        $cat    = isset($_POST['cat']) ? $_POST['cat'] : false;
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

            case "enableprint":
                $blessing->can_print = true;
                $return['addevent'] = 'disableprint';
                $blessing->save();
                break;

            case "disableprint":
                $blessing->can_print = false;
                $return['addevent'] = 'enableprint';
                $blessing->save();
                break;

            default:
                $return['addevent'] = "wtf? ".$intent;

        }

        echo json_encode($return);
        return;
    }

    public function delete(){
        $blessing_factory = Model::factory('Blessing');
        
        $id = $_REQUEST['id'];

        $newblessing = $blessing_factory->find_one($id);
        if($newblessing){
            $newblessing->delete();
        }

        return $this->_redirect("/blesser");
    }

    public function import(){
	//die("Temporarily disabled");
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
            $this->importBlessings($_FILES['import']['tmp_name']);

        } else {
            $this->data['gnav_active'] = "blessr";
            $this->data['lnav_active'] = "import";

            $this->render("blesser/import_form");

        }
    }


    public function export(){
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=blessings.csv');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings

	// fetch the data
	//mysql_connect('localhost', 'username', 'password');
	//mysql_select_db('database');
	//$rows = mysql_query('SELECT field1,field2,field3 FROM table');


        $blessings_cxn = Model::factory('Blessing');
        $blessings_cxn->where('event_id', Event::current());

        $blessings = $blessings_cxn->order_by_asc("target_name")->find_many();

	fputcsv($output, array_keys($blessings[0]->as_array()));
	// loop over the rows, outputting them
	foreach($blessings as $blessing){
	    fputcsv($output, $blessing->as_array());
	}
	fclose($output);
    }

    private function importBlessings($filename, $event_id = 9){

        require('../lib/XLSXReader/XLSXReader.php');
        $xlsx = new XLSXReader($filename);
        $sheets = $xlsx->getSheetNames();


        /*array(10) {
          [0]=>
          string(6) "Number"
          [1]=>
          string(6) "Nation"
          [2]=>
          string(5) "Deity"
          [3]=>
          string(8) "Duration"
          [4]=>
          string(5) "Owner"
          [5]=>
          string(3) "PID"
          [6]=>
          string(6) "Target"
          [7]=>
          string(6) "Reason"
          [8]=>
          string(6) "Effect"
          [9]=>
          string(12) "Curse effect"
}
          */


        //$sheets = array(array_pop($sheets));
        foreach($sheets as $sheet){
            $blessings = $xlsx->getSheetData($sheet);
            echo "<h2>$sheet</h2>";
            foreach($blessings as $i => $blessing){
                if($i == 0){
                    continue;
                }


                $blessing_factory = Model::factory('Blessing');
                


                printf("Looking for %s<br/>", $blessing[0]);
                $newblessing = $blessing_factory->find_one($blessing[0]);
                if($newblessing){
                    printf("Blessing %s exists<br/>", $blessing[0]);
                } else {
                    $newblessing = $blessing_factory->create();
                    $newblessing->event_id = Event::current();
                    $newblessing->date_created = date(DATETIME_MYSQL);
                    $newblessing->id = $blessing[0]; 
                }



                $newblessing->author = 'Excel Import '.date(DATETIME_MYSQL); 
                $newblessing->target_id = $blessing[5]; 
                $newblessing->target_name = $blessing[4]; 
                $newblessing->target_nation = $blessing[1]; 
                $newblessing->blessing_type = $blessing[7]; 
                $newblessing->from_type = ''; 
                $newblessing->issuer = $blessing[2]; 
                $newblessing->description = '';//$blessing[8]; 
                $newblessing->effect = $blessing[8];  
                $newblessing->review_plot = 1; 
                $newblessing->review_ref = 0; 
                $newblessing->review_sane = 0; 
                $newblessing->reason = $blessing[7]; 
                $newblessing->duration = $blessing[3]; 
                $newblessing->date_printed = date(DATETIME_MYSQL); 

                $token = array();
                for ($i=1; $i <= 4; $i++) {
                    $token[$i]['effect'] = null;
                    $token[$i]['count']  = null;
                    $token[$i]['target'] = null;
                }
                if($blessing[9]){
                    $token[1]['effect'] = $blessing[9];
                    $token[1]['count'] = 1;
                    $token[1]['target'] = '';
                }

                $newblessing->tokens = json_encode($token);

                $validate = $newblessing->validate();

                echo '<pre>';
                var_dump($blessing);
                var_dump($newblessing->as_array());
                echo '</pre><hr/>';

                if ($validate === true) {
                    $newblessing->date_edited = date(DATETIME_MYSQL);
                    $newblessing->save();
                } else {
                    var_dump($validate);
                    die();
                }

                $newblessing->save();

            } // Foreach Blessing
        } // Foreach Sheet
    } // Function Import
}
