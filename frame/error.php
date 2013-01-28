<?php


class Error extends Controller {
    
    function FourOhFour($params){
        $this->data = $params;
        $this->renderAlone("errors/fourohfour");
    }
    
    function FiveHundred($params){
        $this->data = $params;
        $this->renderAlone("errors/fivehundred");
    }
    
}

?>
