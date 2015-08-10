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
		$xlsx = new XLSXReader('../data/LesserMysteries.xlsx');

        $sheets = $xlsx->getSheetNames();
	    $mysterydata = array();

	    $sheets = array('Previously Nation-Specifics', 'Already Single Nation', 'Basics', 'World Forge');

	    $this->data['types'] = array();

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
	        		'type' => $mystery[1],
	        		'prime' => $mystery[2],
	        		'coin' => $mystery[3],
	        		'fire' => $mystery[4],
	        		'earth' => $mystery[5],
	        		'air' => $mystery[6],
	        		'water' => $mystery[7],
	        		'any' => $mystery[8],
	        		'blood' => $mystery[9],
	        		'effect' => $mystery[11+$offset]
	        	);

	        	$this->data['types'][$mystery[1]] = 1;
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

    // function cauldron(){
    //     $this->data['lnav_active'] = "cauldron";
    //     $mysteries  = $this->all_mysteries();

    //     uasort($mysteries, array($this, 'sort_mysteries'));
    //     $this->data['mysteries'] = $mysteries;
    //     $this->render("cauldron/index");

    // }

    function index(){
        $this->data['lnav_active'] = "cauldron";
        $mysteries  = $this->all_mysteries();

        uasort($mysteries, array($this, 'sort_mysteries'));
        $this->data['mysteries'] = $mysteries;
        $this->render("cauldron/all_mysteries");

    }

    function printpdf(){
        $this->data['lnav_active'] = "cauldron";
        $mysteries  = $this->all_mysteries();

        uasort($mysteries, array($this, 'sort_mysteries'));
        $this->data['mysteries'] = $mysteries;
        $this->renderAlone("cauldron/print_pdf");

    }


}

?>
