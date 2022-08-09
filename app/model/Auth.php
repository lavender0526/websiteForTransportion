<?php
namespace app\model;
use vendor\DB;
class Auth{
    public static function authaction($id,$action){
        
        $sql1 = "SELECT `roleid` FROM `userrole` WHERE `userid`=?";
        $arg1 = array($id);
        $user=DB::select($sql1, $arg1);
        
        $sql2 = "SELECT `roleid` FROM actions,roleaction WHERE actions.actname=? AND actions.id=roleaction.actionid";
        $arg2 = array($action);
        $actionrole=DB::select($sql2, $arg2);
        return array_intersect(array_column($user['result'],'roleid'),array_column($actionrole['result'],'roleid'));
    }
   
}
?>
