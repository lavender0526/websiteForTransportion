<?php
namespace app\Model;
use vendor\DB;
class Order{
    public function getorders(){
        $sql = "SELECT  *  FROM  `orderform`";
        $arg = NULL;
        return DB::select($sql, $arg);
    }
    public function getorderlist($orderid){
        $sql = "SELECT orderdetail.id,
                        product.id as proid,
                        product.name,
                       orderdetail.count,
                       
                       (orderdetail.total) as price
                       FROM `orderdetail`, `product` WHERE `orderid`=? and `orderdetail`.proid=`product`.id
                ";
        $arg = array($orderid);
        return DB::select($sql, $arg);
    }
    public function neworder($userid, $date){
        $sql = "INSERT INTO `orderform` (`userid`, `date`) VALUES (?, ?)";
        return DB::insert($sql, array($userid, $date));
    }
    public function newitem($orderid, $proid, $count,$price){
        $sql = "INSERT INTO  
                   `orderdetail` 
                   (`orderid`, `proid`, `count`,`total`) 
                    VALUES (?, ?, ?,?)
        ";
        $arg = array($orderid, $proid,intval($count),$price);
        return DB::insert($sql, $arg);
    }
  public function removeorder($id,$order)
  {
      if ($order=='form') {
    
          $sql="DELETE FROM `orderform` WHERE `id`=?;DELETE FROM `orderdetail` WHERE `orderid`=?";
          $arg = array(intval($id),intval($id));
      }
      else {
        $sql="DELETE FROM `orderdetail` WHERE `id`=?";
        $arg = array(intval($id));
      }
      return DB::remove($sql,$arg);
  }
}


?>