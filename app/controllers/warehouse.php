<?php

class Warehouse extends My_Controller {

    function all_items(){
        $this->data['gnav_active'] = "artifacts";
    	require('../lib/XLSXReader/XLSXReader.php');
		$xlsx = new XLSXReader(sprintf('../data/Item List E%d.xlsx', Event::current()));

        $sheets = $xlsx->getSheetNames();
	    $mysterydata = array();


	    $this->data['types'] = array();

	    $sheetdata = array();

        foreach($sheets as $sheet){
        	$sheetdata[$sheet] = array();
	        $items = $xlsx->getSheetData($sheet);
	        //$mysteries = $xlsx->getSheetData('Basics');
	        //var_dump($mysteries);
	        
	        $cols = array_shift($items);

	        foreach($items as $index => $item){
	   			 $retitem = array();
	   			 foreach($item as $i => $row){
	   			 	$retitem[$cols[$i]] = $row;
	   			 }
	   			 $sheetdata[$sheet][] = $retitem;
	        }


	    }
	    return $sheetdata;
    }

    function item($args){
        $this->data['gnav_active'] = "artifacts";
    	list($sheet, $row) = $args;
        $items  = $this->all_items();
        $this->data['item'] = $items[urldecode($sheet)][$row];
        $this->data['sheet'] = $sheet;
        $this->data['row'] = $row;
        $this->render("warehouse/item");

    }

    function printpdf($args){
        $this->data['gnav_active'] = "artifacts";
    	list($sheet, $row) = $args;
        $items  = $this->all_items();
        $this->data['item'] = $items[urldecode($sheet)][$row];
        $this->renderAlone("warehouse/print");

    }

    function index(){
        $this->data['gnav_active'] = "artifacts";
        $items  = $this->all_items();

        unset($items['Ribbon numbers']);
        unset($items['Tables']);
        $this->data['items'] = $items;
        $this->render("warehouse/all_items");

    }

}
