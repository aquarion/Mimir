<?php

/**
 * Description of Cauldron
 *
 * @author Nicholas
 */
class Cauldron extends My_Controller {
    public static $_table = 'cauldron';

    function init(){
    	return true;
    }
    
    
    function all_mysteries(){
    	require('../lib/XLSXReader/XLSXReader.php');
		$xlsx = new XLSXReader('../doc/LesserMysteries.xlsx');

        $sheets = $xlsx->getSheetNames();
	    $mysterydata = array();

	    $sheets = array('Previously Nation-Specifics', 'Already Single Nation');

        foreach($sheets as $sheet){
	        $mysteries = $xlsx->getSheetData($sheet);
	        //$mysteries = $xlsx->getSheetData('Basics');
	        //var_dump($mysteries);

	        if($sheet == 'Previously Nation-Specifics'){
	        	$offset = 5;
	        } else {
	        	$offset = 0;
	        }

	        foreach($mysteries as $index => $mystery){
	        	if(count($mystery) < 12 || $index == 0){
	        		continue;
	        	}

	        	$mysterydata[] = array(
	        		'sheet' => $sheet,
	        		'name' => $mystery[0],
	        		'coin' => $mystery[4],
	        		'fire' => $mystery[5],
	        		'earth' => $mystery[6],
	        		'air' => $mystery[7],
	        		'water' => $mystery[8],
	        		'any' => $mystery[9],
	        		'blood' => $mystery[10],
	        		'effect' => $mystery[12+$offset]
	        	);
	        }

	    }
	    return $mysterydata;
    }

    function sort_mysteries($a, $b){
    	if ($a > $b){
    		return 1;
    	}
    	return -1;
    }

    function index(){
        $this->data['lnav_active'] = "cauldron";
        $mysteries  = $this->all_mysteries();

        uasort($mysteries, array($this, 'sort_mysteries'));
        $this->data['mysteries'] = $mysteries;
        $this->render("cauldron/all_mysteries");

    }


}

?>
