<?php
/**
 * Description of nation
 *
 * @author Nicholas
 */

class Nation {
    
    static function nations(){
        return array(
            'carthage' => array(
                'name'    => 'Carthage',
                'title'   => 'The Dominion of Carthage',
                'since'   => 1
            ),
            'egypt' => array(
                'name'    => 'Egypt',
                'title'   => 'The Kingdom of Egypt',
                'since'   => 1
            ),
            'greece' => array(
                'name'    => 'Greece',
                'title'   => 'The Free Greek City-States',
                'since'   => 1
            ),
            'hellasphoenicia' => array(
                'name'    => 'Hellas Phoenicia',
                'title'   => 'The Platonic Republic of Hellas Phoenicia',
                'since'   => 5
            ),
            'rome' => array(
                'name'    => 'Rome',
                'title'   => 'The Republic of Rome',
                'since'   => 1
            ),
            'persia' => array(
                'name'    => 'Persia',
                'title'   => 'The Persian Empire',
                'since'   => 1
            ),
        );
    }
    
    static function nation_ids(){
        $nations = Nation::nations();
        return array_keys($nations);
    }
        
    static function options(){
        $options = array();
        $nations = Nation::nations();
        foreach($nations as $i => $nation){
            $options[$i] = $nation['name'];
        }
        return $options;
    }
    
    static function title($n){
        $nations = Nation::nations();
        return $nations[$n]['title'];
    }
    
    static function name($n){
        $nations = Nation::nations();
        return $nations[$n]['name'];
    }
    
    static function detail($n){
        $nations = Nation::nations();
        return $nations[$n];
    }
    
    static function nations_array($default = 0){
        $array = array();
        $nations = Nation::nation_ids();
        foreach($nations as $nation){
            $array[$nation] = $default;
        }
        return $array;
    }
}
