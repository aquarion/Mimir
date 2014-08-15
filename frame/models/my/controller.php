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
	return $this->requires_auth();
    	return true;
    }

    function is_allowed(){

        if(isset($_SESSION['authentication'])){
            return true;
        }
        return false;
    }

    protected function requires_auth(){
        if($this->is_allowed()){
            return true;
        }
    	$this->_redirect("/auth/login?redirect=".urlencode($_SERVER['REQUEST_URI']));
    	return false;
    }
}
