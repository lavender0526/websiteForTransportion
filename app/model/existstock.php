<?php
namespace app\model;
use vendor\DB;
class existstock 
{
    public function getexiststocks()
{
    $sql = "SELECT product.id,product.name,IFnull(existstock.count,0) As count FROM product LEFT JOIN existstock ON (existstock.proid=product.id)";
    $arg = NULL;
    return DB::select($sql, $arg);
}
  public function getexiststock($id)
  {
    $sql = "SELECT id,name,count FROM `existstock`,product WHERE existstock.proid=product.id AND `proid`=?";
    $arg = array($id);
    return DB::select($sql, $arg);

  }
  public function removeexiststock($id,$count){
    $sql = "UPDATE `existstock` SET `count`=`count`-? WHERE `proid`=?";
    return DB::remove($sql,array(intval($count),$id)); 
  }
  public function updateexiststock($id,$count){
    $sql="UPDATE `existstock` SET `count`=`count`+? WHERE `proid`=?";
    return DB::update($sql,array(intval($count),$id)); 
  }
}

?>