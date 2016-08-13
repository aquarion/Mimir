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
  
    const current = 13;

    static function events(){
        return array(
            1 => array(
                'title'   => 'Steer of Heaven',
                'sign'    => 'Taurus',
                'element' => 'Earth',
                'year'    => '2010/1',
                'ordinal' => 'First',
            ),
            2 => array(
                'title'   => 'Two Faces of Earth and Sky',
                'sign'    => 'Gemini',
                'element' => 'Air',
                'year'    => '2011/1',
                'ordinal' => 'Second',
            ),
            3 => array(
                'title'   => 'Claws of the Tide King',
                'sign'    => 'Cancer',
                'element' => 'Water',
                'year'    => '2011/2',
                'ordinal' => 'Third',
            ),
            4 => array(
                'title'   => 'Crown of the Sphinx',
                'sign'    => 'Leo',
                'element' => 'Fire',
                'year'    => '2012/1',
                'ordinal' => 'Fourth',
            ),
            5 => array(
                'title'   => 'Queen of the Blood Moon',
                'sign'    => 'Virgo',
                'element' => 'Earth',
                'year'    => '2012/2',
                'ordinal' => 'Fifth',
            ),
            6 => array(
                'title'   => 'Balance of the World',
                'sign'    => 'Libra',
                'element' => 'Air',
                'year'    => '2013/1',
                'ordinal' => 'Sixth',
            ),
            7 => array(
                'title'   => 'Touch of Death',
                'sign'    => 'Scorpio',
                'element' => 'Water',
                'year'    => '2013/2',
                'ordinal' => 'Seventh',
            ),

            8 => array(
                'title'   => 'Arrow of Fire',
                'sign'    => 'Sagittarius',
                'element' => 'Fire',
                'year'    => '2014/1',
                'ordinal' => 'Eighth',
            ),
            9 => array(
                'title'   => 'Dweller in the Deep',
                'sign'    => 'Capricorn',
                'element' => 'Earth',
                'year'    => '2014/2',
                'ordinal' => 'Ninth',
            ),
            10 => array(
                'title'   => 'River of Night\'s Dreaming',
                'sign'    => 'Aquarius',
                'element' => 'Air',
                'year'    => '2015/1',
                'ordinal' => 'Tenth',
            ),

            11 => array(
                'title'   => 'Mirror of the Sea',
                'sign'    => 'Pisces',
                'element' => 'Water',
                'year'    => '2015/2',
                'ordinal' => 'Eleventh',
            ),

            12 => array(
                'title'   => 'Golden Ram',
                'sign'    => 'Aries',
                'element' => 'Fire',
                'year'    => '2016/1',
                'ordinal' => 'Twelfth',
            ),

            13 => array(
                'title'   => 'The Great Wheel of the Fates',
                'sign'    => 'Taurus',
                'element' => 'Earth',
                'year'    => '2016/2',
                'ordinal' => 'Thirteenth',
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

    static function lattr($attr, $event=False){
	if(!$event){
        	$event = Event::current();
        }
	$events = Event::events();
	   return strtolower($events[$event][$attr]);
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
	$max = 13;
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

    static function ordinal($i = false){
        if(!$i){
            $i = Event::current();
        }
        $events = Event::events();
        return $events[$i]['ordinal'];
    }
}

?>
