<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of configuration
 *
 * @author Nicholas
 */
class Config {
    # Begin Singleton Zen
    static private $_instance;
    private $data = array();

    static function getInstance(){
        if(empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct(){
        $this->init();
    }
    # End Singleton Zen
    

    function init(){
            $this->loadFile(CONFIG_LOC.'/../etc/configGlobal.ini');
            $this->loadFile(CONFIG_LOC.'/../etc/configLocal.ini');

    }
    function loadFile($file){
            if (file_exists($file)){
                    if (is_readable($file)){
                            $data = parse_ini_file($file, true);
                            $this->data = array_merge($this->data, $data);
                    } else {
                            throw new Exception('Config File isn\'t readable');
                    }
            } else {
                throw new Exception('Config File '.$file.' isn\'t readable');
            }
    }

    function get($area, $value){
            if (isset($this->data[$area]) && isset($this->data[$area][$value])){
                    #Logger::log('Config', "Got $area/$value as ".$this->data[$area][$value], L_INFO);
                    return $this->data[$area][$value];
            }		
            #Logger::log('Config', "Couldn't get $area/$value", L_DEBUG);
            return false;
    }

    function getArea($area){
            if (isset($this->data[$area])){
                    return $this->data[$area];
            }		
            #Logger::log('Config', "Couldn't get $area", L_TRACE);
            return false;
    }

    function getAll(){
            return $this->data;
    }

    
}

?>
