<?php

class Players extends My_Controller {
    function init(){
        $this->data['gnav_active'] = "players";
        return true;
    }

    function index(){            
        $this->data['lnav_active'] = "players";
        $this->data['players'] = Model::factory('Player')
        		->where('event_id',  Event::current())
        		->find_many();
        $this->render("players/index");
    }

    function import(){            
        $this->data['lnav_active'] = "import";

        if(isset($_FILES['userfile'])){
        	
            require('../lib/XLSXReader/XLSXReader.php');

            $filename = $_FILES['userfile']['tmp_name'];

            $xlsx = new XLSXReader($filename);
            $sheets = $xlsx->getSheetNames();
			
			$players = $xlsx->getSheetData(1);

			

			ORM::configure('logging', true);

		    foreach($players as $id => $data) {
		    	$player_factory = Model::factory('Player');
		    	if($id == 0){
		    		continue;
		    	}

                $player = $player_factory
                	->where('event_id',  Event::current())
                	->where('pid',  $data[0])
                	->find_one();

                if(!$player){
                    $player = $player_factory->create();
                }

		    	$player->pid       = $data[0];
				$player->player    = $data[1];
				$player->location  = $data[2];
				$player->character_name = $data[3];
				$player->group  = $data[4];
				$player->nation = $data[5];
				$player->path   = $data[6];
				$player->kit    = $data[7] == "Yes";
				// $player->email  = $data[8];
				$player->event_id  = Event::current();

				try {
					$player->save();
				} catch (Exception $e){
					var_dump(ORM::get_query_log());
					throw $e;
				}
				//var_dump($player->asArray());
		    }

			$this->_redirect("/players");
        }

        $this->render("players/import");
    }

    function alljson(){
		$player_factory = Model::factory('Player');
        
        $players = $player_factory
        	->where('event_id',  Event::current())
        	->find_many();

        $out = array();
        foreach($players as $player){
        	$bang = explode(" ", $player->path); 
        	$player->path = $bang[0];
        	$out[] = $player->asArray();
        }
        $this->renderJson($out);

    }
}