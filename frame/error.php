<?php


class Error extends Controller {
    
    function FourOhFour($params){
        $this->data = $params;
	header("HTTP/1.0 404 Not Found");
        $this->renderAlone("errors/fourohfour");
    }
    
    function FiveHundred($params){
	header("HTTP/1.0 500 Everything's Fucked");
        $this->data = $params;
        $this->renderAlone("errors/fivehundred");
    }
    
}

?>
