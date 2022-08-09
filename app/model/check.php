<?php
namespace app\model;
use vendor\DB;
class check
{
    public function getchecks()
{
    $sql = "SELECT  *  FROM  `orderform`";
    $arg = NULL;
    return DB::select($sql, $arg);
}
  
  public function newcheck($name,$payment,$total,$orderid,$delivery,$receive,$phone){
    $sql = "INSERT INTO `checkdata` (`orderid`,`payment`,`delivery`,`name`,`phone`,`receivpeople`,`total`) VALUES (?,?,?,?,?,?,?)";
    return DB::insert($sql, array($orderid,$payment,$delivery,$name,$phone,$receive,$total));
  }
  public function getcheckrecord(){
    $sql = "SELECT * FROM `checkdata`";
    $arg=null;
    return DB::select($sql, $arg);
  }
  
}

?>