<?php

class Router {
    
    function route($path){
        $path = explode("/", $path);
        array_shift($path);
        
        $route = new Route();
        
        $route->Controller = "Error";
        $route->Action     = "index";
        $route->Parameters = array();
        $route->Path       = $path;
                
        if (count($path) == 0 || $path[0] == "home" || empty($path[0])) {
            $route->Controller = "StaticPages";
            $route->Action     = "index";
            return $route;
        }
        
        if(count($path)){
            $route->Controller = array_shift($path);
        }
        if(count($path)){
            $action     = array_shift($path);
            if($action){
                $route->Action = $action;
            }
        }
        if(count($path)){
            $route->Parameters = $path;
        }
        
        return $route;
    }
    
}
