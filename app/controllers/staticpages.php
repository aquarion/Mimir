<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Static
 *
 * @author Nicholas
 */
class StaticPages extends My_Controller {
    
    function index(){
        $this->render("frontpage");
    }

    function news(){
	$n = 50;
        $log = explode("\n", shell_exec("git log -n" . $n));
        //$thiscommit = new stdClass();
        //$thiscommit->log = array();
        $commits = array();

	//var_dump($log);
        foreach ($log as $line) {
            if (substr($line, 0, 6) == "commit") {
                #$thiscommit->log = implode("\n", $thiscommit->log);
                if (isset($thiscommit)) {
                    if (strpos($thiscommit->log[0], "[PRIVATE]")) {
                        
                    } elseif (substr($thiscommit->log[0], -1, 1) == ".") {
                        
                    } else {
                        $commits[] = $thiscommit;
                    }
                }
                $thiscommit = new stdClass();
                $thiscommit->log = array();
		$thiscommit->sha = substr($line, 7);
            } elseif (substr($line, 0, 5) == "Date:") {
                $thiscommit->date = strtotime(substr($line, 7));
            } elseif (substr($line, 0, 7) == "Author:") {
                $author = array(); //populated by regex
                preg_match("/Author: (.*?) <(.*?)>/", $line, $author);
                $thiscommit->author = $author[1];
                $thiscommit->email = $author[2];
            } elseif (trim($line)) {
                $thiscommit->log[] .= trim($line);
            }
        }
        $this->data['commits'] = $commits;

        $this->render("news");
    }
}
?>
