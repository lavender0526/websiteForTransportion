<?php

namespace app\Middleware;
use \Exception;
use \vendor\JWT\JWT;
use vendor\DB;
class AuthMiddleware{
    public static function checkToken(){
        $headers = getallheaders();
        $jwt = $headers['Authorization'];
        $secret_key = "YOUR_SECRET_KEY";
        try {
            $payload = JWT::decode($jwt, $secret_key, array('HS256'));
            $jwt = AuthMiddleware::genToken($payload->data->id);
            $response['status'] = 200;
            $response['message'] = "Access granted";
            $response['token'] = $jwt[0];
            $response['user'] = $jwt[1];
        
           
        } catch (Exception $e) {
            $response['status'] = 403;
            $response['message'] = '登入已過時，請重新登入';
        }
        return($response);
    }
    public static function doLogin(){
        $id = $_POST['id'];
        $password = $_POST['password'];
        $sql="SELECT * FROM user WHERE id=? AND password=?";
        $arg=array($id,$password);
        $excute=DB::select($sql,$arg);
        if ($excute['result']!=[]) {
            $jwt = AuthMiddleware::genToken($id);
            $response['status'] = 200;
            $response['message'] = "Access granted";
            $response['token'] = $jwt[0];
            $response['data']=$excute;
            // $response['user'] = $jwt[1];
  
         
        }
        else {
            $response['status'] = 403;
            $response['message'] = "帳號密碼錯誤";
            
        }
        return($response);
    }
    private static function genToken($id){
        $secret_key = "YOUR_SECRET_KEY";
        $issuer_claim = "http://localhost:8888";
        $audience_claim = "http://localhost:8888";
        $issuedat_claim = time(); 
        $expire_claim = $issuedat_claim + 60;
        $payload = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $id,
        ));
        $jwt = JWT::encode($payload, $secret_key);
        return array($jwt,$id);
    }
    public static function authaction($id,$action){
        #先找出使用者有什麼樣的身份
        $sql1 = "SELECT `roleid` FROM `userrole` WHERE `userid`=?";
        $arg1 = array($id);
        $user=DB::select($sql1, $arg1);
        #找出這個功能有哪些身份能用
        $sql2 = "SELECT `roleid` FROM actions,roleaction WHERE actions.actname=? AND actions.id=roleaction.actionid";
        $arg2 = array($action);
        $actionrole=DB::select($sql2, $arg2);
       
       
        $r=array_intersect(array_column($user['result'],'roleid'),array_column($actionrole['result'],'roleid'));
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
