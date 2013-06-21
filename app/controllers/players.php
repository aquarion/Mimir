<?php

class Players extends My_Controller {
    function init(){
        $this->data['gnav_active'] = "players";
        return true;
    }

    function index(){            
        $this->data['lnav_active'] = "players";
        $this->data['players'] = Model::factory('Player');
        $this->render("players/index");
    }

    function import(){            
        $this->data['lnav_active'] = "import";

        if(isset($_FILES['userfile'])){
        	var_dump($_FILES);
			$row = 1;
			if (($handle = fopen($_FILES['userfile']['tmp_name'], "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			    	$player = Model::factory('Player')->create();
			    	$player->pid       = $data[0];
					$player->player    = $data[1];
					$player->location  = $data[2];
					$player->character = $data[3];
					$player->group  = $data[4];
					$player->nation = $data[5];
					$player->path   = $data[6];
					$player->kit    = $data[7];
					$player->email  = $data[8];
					$player->event  = Event::current();

					$player-save();
			    }
			    fclose($handle);
			}
			//$this->_redirect("/players");
        }

        $this->render("players/import");
    }
}