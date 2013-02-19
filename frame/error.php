<?php


class Error extends Controller {
    
    function FourOhFour($params){
        $this->data = $params;
        http_response_code(404);
        $this->renderAlone("errors/fourohfour");
    }
    
    function FiveHundred($params){
        http_response_code(500);
        $this->data = $params;
        $this->renderAlone("errors/fivehundred");
    }
    
}

?>
