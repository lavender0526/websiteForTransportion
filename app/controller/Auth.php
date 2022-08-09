<?php
namespace app\Controller;
use vendor\Controller;
use app\model\auth as authmodel;
class Auth extends Controller{
    public function __construct() {
       
    }
    public static function authaction($id,$action){
        $r=authmodel::authaction($id,$action);
        if (count($r)!=0) {
            $response['status']=200;
            $response['message']='Access granted';
         
        }
        else {
            $response['status']=403;
            $response['message']='並無權限';
            
        }
        return $response;
    }
}


?>