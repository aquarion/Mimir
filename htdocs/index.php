<?PHP

define("APP_LOC",   realpath("../app"));
define("FRAME_LOC", realpath("../frame"));
define("VIEWS_LOC", realpath("../views/"));

class Exception_ClassNotFound extends Exception {
    
}
class Exception_TemplateNotFound extends Exception {
    
}

function frame_autoloader($class) {
    $class = strtr($class, "_", "/");
    $locations = array(
        APP_LOC.'/models/' . $class . '.php',
        APP_LOC.'/controllers/' . $class . '.php',
        APP_LOC.'/'.$class . '.php',
        FRAME_LOC.'/'.$class . '.php',
        FRAME_LOC.'/models/'.$class . '.php',
        FRAME_LOC.'/controller/'.$class . '.php',
    );
    foreach($locations as $location){
        $location = strtolower($location);
        #print "check $location<br/>";
        if(file_exists($location)){
            require_once($location);
            return;
        }
    }
    throw new Exception_ClassNotFound("$class not found!");
    
}

spl_autoload_register('frame_autoloader');

$router = new Router();
$route = $router->route($_SERVER['REQUEST_URI']);

try {
    $controller = new $route->Controller;
} catch(Exception_ClassNotFound $e){
    $controller = new Error();
    $route->Action = "FourOhFour";
    $route->Parameters = array('page' => $_SERVER['REQUEST_URI'], 'message' => 'Failed on Controller "'.$route->Controller.'"', 'exception' => $e);
}

if(method_exists($controller, $route->Action)){
    try{
        call_user_func(array($controller, $route->Action), $route->Parameters);
    } catch (Exception $e){
       $controller = new Error();
       $route->Parameters = array('page' => $_SERVER['REQUEST_URI'], 'exception' => $e);      
       $route->Action = "FiveHundred";
       call_user_func(array($controller, $route->Action), $route->Parameters);
    }
} else {
    $controller = new Error();
    $route->Parameters = array('page' => $_SERVER['REQUEST_URI'], 'message' => 'Failed on "'.$route->Controller.'/'.$route->Action.'"');    
    $route->Action = "FourOhFour";
    call_user_func(array($controller, $route->Action), $route->Parameters);
}