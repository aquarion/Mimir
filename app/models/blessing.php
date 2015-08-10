<?php

use \Michelf\Markdown;

/**
 * Description of blessing
 *
 * @author Nicholas
 */
class Blessing extends My_Model {

    public static $_table = 'blessing';

    public function validate_event_id($value){
        return $this->_validate_numeric("Event", $value);
    }

    public function validate_author($value){
        return $this->_validate_required("Author", $value);
    }

    public function validate_target_id($value){
        return $this->_validate_numeric("Target PID", $value);
    }
    public function validate_target_name($value){
        return $this->_validate_required("Target's Name", $value);
    }
    // public function validate_blessing_type($value){
    //     return $this->_validate_required("Blessing Type", $value);
    // }
    // public function validate_reason($value){
    //     return $this->_validate_required("Reason", $value);
    // }
    public function validate_duration($value){
        return $this->_validate_required("Duration", $value);
    }
    // public function validate_description($value){
    //     //return $this->_validate_required("Description", $value);
    // }

    public function validate_effect($value){
        return $this->_validate_required("Effect", $value);
    }
    public function validate_issuer($value){
        return $this->_validate_required("Issuer", $value);
    }
    // public function validate_from_type($value){
    //     //return $this->_validate_required("Source", $value);
    // }

    public function validate_token_count($value){
        foreach($value as $i => $int){
        	if($int){
        		$res = $this->_validate_required("If Count > 0, Token $i Effect", $_POST['token_effect'][$i]);
        		if($res){
        			return $res;
        		}
        		return False;
        	}
        }

    }


	function token($count, $value){
		$decode = json_decode($this->tokens, true);
		if (isset($decode[$count]) and isset($decode[$count][$value])){
			return $decode[$count][$value];
		}
		return false;
	}

	function has_tokens(){
		// echo '<pre>'.print_r(json_decode($this->tokens, true),1).'</pre>';
		return $this->token(1, 'count')
			+ $this->token(2, 'count')
			+ $this->token(3, 'count')
			+ $this->token(4, 'count');
	}



    function count_token_sets(){
        $out = 0;
	$tokens = json_decode($this->tokens, true);
        foreach($tokens as $id => $token){
            if($token['count']){
                $out++;
            }
        }
        return $out;
    }


    function tokens(){
        $tokens = json_decode($this->tokens, true);
        $return = array();
        foreach($tokens as $id => $token){
            if($token['count']){
                $token['blessing'] = $this->id;
                $token['token_id'] = $id;
                $return[] = $token;
            }
        }
        return $return;
    }

    function is_reviewed(){
        /* review_plot tinyint,
    review_ref tinyint,
    review_sane tinyint,*/
        if(!$this->review_plot){
            return False;
        } elseif (!$this->review_ref){
            return False;
        } elseif (!$this->review_sane){
            return False;
        }
        return True;
    }

    function is_printed(){
        /* review_plot tinyint,
    review_ref tinyint,
    review_sane tinyint,*/
        if(!$this->date_printed){
            return False;
        }
        return True;
    }

    function allow_print(){
        if ($this->is_reviewed() && $this->can_print){
            return True;
        } 

        return False;
    }


    static function god_list_json(){
        return json_encode(blessing::god_list());
    }
    static function god_list(){
        return array(
            'CARTHAGE: Astarte',
            'CARTHAGE: Athtar',
            'CARTHAGE: Baal',
            'CARTHAGE: Dagon',
            'CARTHAGE: Dionysos Reborn',
            'CARTHAGE: El',
            'CARTHAGE: Eshmun',
            'CARTHAGE: Kothar-na-Khasis',
            'CARTHAGE: Melqart',
            'CARTHAGE: Adonis',
            'CARTHAGE: Shapash',
            'CARTHAGE: Tanit',
            'CARTHAGE: Yam',
            'CARTHAGE: DEATH MESSENGER – Mot',
            'CARTHAGE: OTHER (specify in Comments)',

            'EGYPT: Anubis',
            'EGYPT: Apep',
            'EGYPT: Bast',
            'EGYPT: Bes',
            'EGYPT: Geb',
            'EGYPT: Hathor',
            'EGYPT: Horus',
            'EGYPT: Isis',
            'EGYPT: Khnum',
            'EGYPT: Nephthys',
            'EGYPT: Nut',
            'EGYPT: Osiris',
            'EGYPT: Pharoah Perdikkas ',
            'EGYPT: Ra',
            'EGYPT: Sekhmet',
            'EGYPT: Shu',
            'EGYPT: Sutekh',
            'EGYPT: Sobek',
            'EGYPT: Tefnut',
            'EGYPT: Thoth',
            'EGYPT: DEATH MESSENGER – Aken',
            'EGYPT: OTHER (specify in Comments)',

            'GREECE: Aion',
            'GREECE: Aphrodite',
            'GREECE: Apollo',
            'GREECE: Ares',
            'GREECE: Artemis',
            'GREECE: Deimos',
            'GREECE: Demeter',
            'GREECE: Eris',
            'GREECE: Erebus',
            'GREECE: Ganymede ',
            'GREECE: Hades',
            'GREECE: Hera',
            'GREECE: Hestia',
            'GREECE: Hyperion',
            'GREECE: Hypnos',
            'GREECE: Iapetus',
            'GREECE: Kronus',
            'GREECE: Leto',
            'GREECE: Mnemosyne',
            'GREECE: Nemesis ',
            'GREECE: Nike',
            'GREECE: Ophion',
            'GREECE: Phobos',
            'GREECE: Persephone',
            'GREECE: Poseidon',
            'GREECE: Rhea',
            'GREECE: Tethys',
            'GREECE: Theia',
            'GREECE: Themis',
            'GREECE: DEATH MESSENGER – Charon',
            'GREECE: OTHER (specify in Comments)',

            'PERSIA (NEW): Aesma Daeva',
            'PERSIA (NEW): Ahura Mazda (Ohrmazd)',
            'PERSIA (NEW): Amitra',
            'PERSIA (NEW): Angra Mainyu (Ahriman)',
            'PERSIA (NEW): Sraosha',
            'PERSIA (NEW): The Arch-Daevas',
            'PERSIA (NEW): The Bounteous Immortals',
            'PERSIA (NEW): The Risen Darius ',
            'PERSIA (NEW): DEATH MESSENGER – Asto Vidatu',

            'PERSIA (OLD): Amitra',
            'PERSIA (OLD): Anu',
            'PERSIA (OLD): Azi Dahak',
            'PERSIA (OLD): Enki',
            'PERSIA (OLD): Ereshkigal',
            'PERSIA (OLD): Ishtar',
            'PERSIA (OLD): Kiu',
            'PERSIA (OLD): Marduk',
            'PERSIA (OLD): Nergal',
            'PERSIA (OLD): Ninhursag',
            'PERSIA (OLD): Pazuzu',
            'PERSIA (OLD): Shamash',
            'PERSIA (OLD): Sin',
            'PERSIA (OLD): Tiamat',
            'PERSIA (OLD): Asto Vidatu',
            'PERSIA (OLD): DEATH MESSENGER - Namtar',

            'PERSIA (OTHER): Ur',
            'PERSIA: OTHER (Specify in Comments)',


            'ROME: Cybele/Diana/Juno/Rhea Silvia',
            'ROME: Dis Pater/Pluto/Orcus',
            'ROME: Erebus',
            'ROME: Janus/Amitra',
            'ROME: Jupiter',
            'ROME: Mars/Remus/Vulcan',
            'ROME: Mercury/Romulus',
            'ROME: Metis',
            'ROME: Mithras',
            'ROME: Cardea/Carna/Vesta/Venus',
            'ROME: Neptune/Proteus',
            'ROME: Pan',
            'ROME: Saturn',
            'ROME: Salacia',
            'ROME: DEATH MESSENGER – Tiberinus',
            'ROME: OTHER (specify in Comments)',

            'HP: Athena Britomartis',
            'HP: Hephaestus Reforged',
            'HP: Moloch',
            'HP: Herakles',
            'HP: Atargatis',
            'HP: Yamm',
            'HP: Adonis',
            'HP: Prometheus',
            'HP: DEATH MESSENGER - Asterius',
            'HP: OTHER (specify in Comments)',

            'TITAN: Pan'

        );
    }
}

?>
