<?php
namespace app\model;
use vendor\DB;
class product 
{
    public function getproducts()
{
    $sql = "SELECT  *  FROM  `product`";
    $arg = NULL;
    return DB::select($sql, $arg);
}
  public function getproduct($id)
  {
    $sql = "SELECT  *  FROM  `product` WHERE `id`=?";
    $arg = array($id);
    return DB::select($sql, $arg);

  }
  public function newproduct($id,$name,$cpu,$ram,$rom,$price){
    $sql = "INSERT INTO `product` (`id`,`name`, `cpu`,`ram`,`rom`, `price`,`rank`) VALUES (?,?,?,?,?,?,?);INSERT INTO `existstock` (`proid`,`count`) VALUES (?,?)";
    return DB::insert($sql, array($id,$name,$cpu,$ram,$rom,intval($price),0,$id,0));
  }
  public function removeproduct($id){
    $sql = "DELETE FROM `product` WHERE id=?";
    return DB::remove($sql,array($id)); 
  }
  public function updateproduct($name,$cpu,$ram,$rom,$price,$id){
    $sql="UPDATE `product` SET `name`=?,`cpu`=?,`ram`=?,`rom`=?, `price`=? WHERE `id`=?";
    return DB::update($sql,array($name,$cpu,$ram,$rom,intval($price),$id)); 
  }
}

?>