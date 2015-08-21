<?PHP
session_start();

require_once '../lib/idiorm/idiorm.php';
require_once '../lib/paris/paris.php';
require_once '../lib/php-markdown-lib/Michelf/Markdown.php';

define("APP_LOC",   realpath("../app"));
define("LIBS_LOC",   realpath("../lib"));
define("FRAME_LOC", realpath("../frame"));
define("VIEWS_LOC", realpath("../views/"));
define("CONFIG_LOC", realpath("../etc/"));

define("DATETIME_MYSQL", 'Y-m-d H:i:s');

set_include_path(get_include_path() . PATH_SEPARATOR . LIBS_LOC.'php-markdown-lib\Michelf'); // Markdown


class Exception_ClassNotFound extends Exception {
    
}
class Exception_TemplateNotFound extends Exception {
    
}
class Exception_FourOhFour extends Exception {
    
}

function frame_autoloader($class) {
    if(class_exists($class)){
        return;
    }
    $class = strtolower(strtr($class, "_", "/"));
    $locations = array(
        APP_LOC.'/models/' . $class . '.php',
        APP_LOC.'/controllers/' . $class . '.php',
        APP_LOC.'/'.$class . '.php',
        FRAME_LOC.'/'.$class . '.php',
        FRAME_LOC.'/models/'.$class . '.php',
        FRAME_LOC.'/controller/'.$class . '.php',
    );
    foreach($locations as $location){
        if(file_exists($location)){
            require_once($location);
            return;
        }
    }
    throw new Exception_ClassNotFound("$class not found!");
    
}

spl_autoload_register('frame_autoloader');

$config = Config::getInstance();

$db_uri = sprintf('mysql:host=%s;dbname=%s', $config->get("database", "host"), $config->get("database", "name"));

ORM::configure($db_uri);
ORM::configure('username', $config->get("database", "user"));
ORM::configure('password', $config->get("database", "password"));


$router = new Router();

$path = $_SERVER['REQUEST_URI'];

if($path == "/news"){
	$path = "/StaticPages/news";
}

$route = $router->route($path);

try {
    $controller = new $route->Controller;
} catch(Exception_ClassNotFound $e){
    $controller = new Error();
    $route->Action = "FourOhFour";
    $route->Parameters = array('page' => $_SERVER['REQUEST_URI'], 'message' => 'Failed on Controller "'.$route->Controller.'"', 'exception' => $e);
}

if(method_exists($controller, $route->Action) || method_exists($controller, "__call")){
    
    try{
        $res = $controller->init();
        if($res){
            call_user_func(array($controller, $route->Action), $route->Parameters);
        }
    } catch (Exception_FourOhFour $e){
       $controller = new Error();
       $route->Parameters = array('page' => $_SERVER['REQUEST_URI'], 'exception' => $e);      
       $route->Action = "FourOhFour";
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
