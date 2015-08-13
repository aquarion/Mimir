<?php

class Briefencounter extends My_Controller {
    function init(){
        $this->data['gnav_active'] = "briefencounter";
        return $this->requires_auth();
    }


    function index(){
        $directories = Config::getInstance()->getArea('directories');

        foreach($directories as $section => $home){
            $directories[$section] = array(
                'dir' => $home, 
                'fileset' => glob($home)
            );
        }

        $this->data['directories'] = $directories;
        $this->render("briefencounter/index");

    }

    function show($args){
        $directories = Config::getInstance()->getArea('directories');
        $section = urldecode($args[0]);
        $file = urldecode($args[1]);
        $f = fopen(dirname($directories[$section]).'/'.$file, 'rb');
        if(!$f){
            die("Failed");
        }
        header("Content-Type: application/pdf");
        while($l = fread($f, 1024)){
            print $l;
        }
        die();
    }

}
