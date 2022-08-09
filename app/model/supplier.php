<?php
namespace app\model;
use vendor\DB;
class supplier
{
    public function getsuppliers()
{
    $sql = "SELECT `SupplierId`,`SupplierName`,`name`,`id`,`City`,`Address`,`Contact`,`Phone` FROM `supplier`,product WHERE supplier.proid=product.id";
    $arg = NULL;
    return DB::select($sql, $arg);
}
  public function getsupplier($id)
  {
    $sql = "SELECT `SupplierId`,`SupplierName`,`name`,`id`,`City`,`Address`,`Contact`,`Phone` FROM `supplier`,product WHERE supplier.proid=product.id AND supplier.SupplierId=?";
    $arg = array($id);
    return DB::select($sql, $arg);

  }
  public function newsupplier($supid,$supname,$proid,$city,$address,$contact,$phone){
    $sql = "INSERT INTO `supplier` (`SupplierId`,`SupplierName`,`proid`,`City`,`Address`,`Contact`,`Phone`) VALUES (?,?,?,?,?,?,?)";
    return DB::insert($sql, array($supid,$supname,$proid,$city,$address,$contact,$phone));
  }
  public function removesupplier($id){
    $sql = "DELETE FROM `supplier` WHERE SupplierId=?";
    return DB::remove($sql,array($id)); 
  }
  public function updatesupplier($supname,$proid,$city,$address,$contact,$phone,$supid){
    $sql="UPDATE `supplier` SET `SupplierName`=?,`proid`=?,`City`=?,`Address`=?,`Contact`=?,`Phone`=? WHERE `SupplierId`=?";
    return DB::update($sql,array($supname,$proid,$city,$address,$contact,$phone,$supid)); 
  }
}

?>