<?php

class Controller {
    
    public $data = array();
    
    function render($template){
        $this->template = $template.".php";
        foreach($this->data as $index => $value){
            $$index = $value;
        }
        
        if(!file_exists(VIEWS_LOC.'/'.$this->template)){
            throw new Exception_TemplateNotFound("Couldn't load template ".VIEWS_LOC.'/'.$this->template);
        }
        
        include(VIEWS_LOC."/fragments/header.php");
        include(VIEWS_LOC.'/'.$this->template);
        include(VIEWS_LOC."/fragments/footer.php");
    }
    
    function renderAlone($template){
        $this->template = $template.".php";
        foreach($this->data as $index => $value){
            $$index = $value;
        }
        
        if(!file_exists(VIEWS_LOC.'/'.$this->template)){
            throw new Exception_TemplateNotFound("Couldn't load template ".VIEWS_LOC.'/'.$this->template);
        }
        
        #include(VIEWS_LOC."/fragments/header.php");
        include(VIEWS_LOC.'/'.$this->template);
        #include(VIEWS_LOC."/fragments/footer.php");
    }

    function renderJson($array){
        header("Content-Type: text/json");
        print json_encode($array);
        return;
    }
    
    function __call($method, $arguments){
        throw new Exception_FourOhFour("$method Not found");
    }
}