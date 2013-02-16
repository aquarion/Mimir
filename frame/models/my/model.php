<?php
/**
 * Description of my_model
 *
 * @author Nicholas
 */
class My_Model extends Model {
    
    public function save(){
        if($this->validate() === true){
            parent::save();
        } else {
            throw new Exception("Not saving invalid data");
        }
    }
    
    public function validate(){
        $datarray = $this->as_array();
        $fails = 0;
            
        foreach($datarray as $index => $value){
            $methodname = "validate_".$index;
                        
            
            if(method_exists($this, $methodname)){
                $result = $this->$methodname($value);
                if ($result !== True){
                    $form_errors[$index] = $result;
                    $fails++;
                }
            }
            
        }
        
        if ($fails > 0){
            return $form_errors;
        } else {
            return true;
        }
        
    }
    
    
    protected function _validate_required($label, $data){
        $data = trim($data);
        if (empty($data)){
            return "$label is required.";
        } else {
            return true;
        }
    }
    
    protected function _validate_numeric($label, $data){
        $data = trim($data);
                
        if (!$data || empty($data)){
            return "$label is required.";
        } else {
            return true;
        }
    }
}

?>
