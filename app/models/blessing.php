<?php

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
}

?>
