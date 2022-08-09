<?php
namespace vendor;
use vendor\Controller;
use vendor\DB;

class repeat extends Controller
{ 
    static function verify($arr,$sheet){
        DB::connect();
        $response=array();
    foreach ($arr as $key=>$value) {
      
        $sql="SELECT * FROM `$sheet` WHERE `$key`='$value'";
        $result=DB::select($sql,array($value));
        
        if($value==$result['result'][0][$key]){
            array_push($response,$value);
        }
      
    }
    return $response;
}    
}

?>
