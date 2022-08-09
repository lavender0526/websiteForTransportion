<?php

namespace app\Controller;
use vendor\Controller;
use vendor\repeat;
use app\model\supplier as suppliermodel;
class supplier extends Controller

{
    public function __construct() {
        $this->em = new suppliermodel();
    }
    public function getsupplier(){
        
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            return $this->em->getsupplier($id);
        } else {
            return $this->em-> getsuppliers();
        }
       
        
       
    }
    public function newsupplier(){
        $supid = $_POST['supid'];
        $supname = $_POST['supname'];
        $proid = $_POST['proid'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $contact=$_POST['contact'];
        $phone=$_POST['phone'];
        $repeat=repeat::verify(array('SupplierId'=>$supid,'SuppplierName'=>$supname,'Contact'=>$contact,'Address'=>$address,'Phone'=>$phone),'supplier');
       
     
        $count=count($repeat);
        if ($count==0) {
           
            return $this->em-> newsupplier($supid,$supname,$proid,$city,$address,$contact,$phone);
        }
        else {
            return self::response(204,"已被使用",$repeat);
        }


    }
    public function removesupplier(){
        $supid = $_POST['id'];
        
        
       return $this->em-> removesupplier($supid); 
    }
    public function updatesupplier(){
        $supid = $_POST['supid'];
        $supname = $_POST['supname'];
        $proid = $_POST['proid'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $contact=$_POST['contact'];
        $phone=$_POST['phone'];
        
        
         
          return $this->em-> updatesupplier($supname,$proid,$city,$address,$contact,$phone,$supid); 
    

    }
    
   
}

?>