<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of event
 *
 * @author Nicholas
 */
class Event {
    
    const current = 9;
    
    static function events(){
        return array(
            1 => array(
                'title'   => 'Steer of Heaven',
                'sign'    => 'Taurus',
                'element' => 'Earth',
                'year'    => '2010/1',
            ),
            2 => array(
                'title'   => 'The Two Faces of Earth and Sky',
                'sign'    => 'Gemini',
                'element' => 'Air',
                'year'    => '2011/1',
            ),
            3 => array(
                'title'   => 'The Claws of the Tide King',
                'sign'    => 'Cancer',
                'element' => 'Water',
                'year'    => '2011/2',
            ),
            4 => array(
                'title'   => 'Crown of the Sphinx',
                'sign'    => 'Leo',
                'element' => 'Fire',
                'year'    => '2012/1',
            ),
            5 => array(
                'title'   => 'Queen of the Blood Moon',
                'sign'    => 'Virgo',
                'element' => 'Earth',
                'year'    => '2012/2',
            ),
            6 => array(
                'title'   => 'The Balance of the World',
                'sign'    => 'Libra',
                'element' => 'Air',
                'year'    => '2013/1',
            ),
            7 => array(
                'title'   => 'The Touch of Death',
                'sign'    => 'Scorpio',
                'element' => 'Water',
                'year'    => '2013/2',
            ),

            8 => array(
                'title'   => 'The Arrow of Fire',
                'sign'    => 'Sagittarius',
                'element' => 'Fire',
                'year'    => '2014/1',
            ),
            9 => array(
                'title'   => 'The Dweller in the Deep',
                'sign'    => 'Capricon',
                'element' => 'Earth',
                'year
            // The Future'    => '2014/2',
            ),
            10 => array(
                'title'   => 'The River of Night\'s Dreaming',
                'sign'    => 'Aquarius',
                'element' => 'Air',
                'year'    => '2015/1',
            ),

            11 => array(
                'title'   => 'The Mirror of the Sea',
                'sign'    => 'Pisces',
                'element' => 'Water',
                'year'    => '2015/2',
            ),

            12 => array(
                'title'   => 'The Golden Ram',
                'sign'    => 'Aries',
                'element' => 'Fire',
                'year'    => '2016/1',
            ),

            13 => array(
                'title'   => '2016/2',
                'sign'    => 'Taurus',
                'element' => 'Earth',
                'year'    => '2016/2',
            )
        );
    }
    
    static function current(){
        if(isset($_COOKIE['event'])){
            return $_COOKIE['event'];
        }
        return Event::current;
    }
    
    static function latest_event(){
        return Event::current;
    }

    static function current_attribute($attr){
        $event = Event::current();
        $events = Event::events();
	return $events[$event][$attr];
    }
    
    static function set_current($value){
        setcookie("event", $value, 0, '/');
    }
    
    static function options(){
        $options = array();
        $events = Event::events();
	$max = Event::current +1;
	if(!isset($events[$max])){
		//$max = Event::current;
	}
        for($i=1;$i <= $max; $i++){
            $options[$i] = $i.": ".$events[$i]['title'];
        }
        //foreach($events as $i => $event){
         //   $options[$i] = $events[$i]['title'];
        //}
        return $options;
    }
    
    static function title($i = false){
        if(!$i){
            $i = Event::current();
        }
        $events = Event::events();
        return $events[$i]['title'];
    }
}

?>
