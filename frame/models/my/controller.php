<?PHP
/**
 * Description of controller
 *
 * @author Nicholas
 */
class My_Controller extends Controller {
    function _redirect($to){
        header("Location:".$to);
    }

    function init(){
    	
    }
}
