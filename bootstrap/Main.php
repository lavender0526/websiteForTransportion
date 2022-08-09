<?php
// error_reporting(E_ALL);
// ini_set('display_errors','On');
require_once __DIR__.'/../vendor/Autoload.php';

use vendor\DB;
use vendor\router;
use app\Middleware\AuthMiddleware;
use app\Controller\Auth;


class Main 
{
   static function run(){
    $conf=parse_ini_file( __DIR__ .'/../vendor/config.ini');
    DB::$db_host=$conf['db_host'];
    DB::$db_name=$conf['db_name'];
    DB::$db_user=$conf['db_user'];
    DB::$db_password=$conf['db_password'];
    if(isset($_GET['action'])) 
    $action=$_GET['action'];
    else
    $action='no_action';
    $response=$responseToken = AuthMiddleware::checkToken();
    if($responseToken['status'] == 200){
        if($action != "no_action") { 
            $intersection=auth::authaction($response['user'],$action);
            if ($intersection['status']==200) {
            
                $router = new Router();
                require_once __DIR__ . "/../routes/web.php";
                $response = $router->run($action);
                $response['token'] = $responseToken['token'];
                
                $response['intse'] = $intersection;
            }
            else {
                $response['status']=403;
                $response['message']='並無權限';
                $response['token'] = $responseToken['token'];
                
              

            }
            
            
        }
    }
    else {
        switch($action){
            case "doLogin":
                $response =AuthMiddleware::doLogin();
            default:
                break;
        }  
    }
    echo json_encode($response);

    }
}

?>