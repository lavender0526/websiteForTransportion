<?php

namespace app\Controller;
use vendor\Controller;
use app\Model\Order as ordermodel;
use app\model\check as checkmodel;
class check extends Controller

{
    public function __construct() {
        $this->em = new checkmodel();
        $this->om = new ordermodel();
    }
    public function getcheck(){
        
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            return $this->em->getcheck($id);
        } else {
            return $this->em-> getchecks();
        }
       
        
       
    }
    public function newcheck(){
       
        $name = $_POST['name'];
        $payment = $_POST['payment'];
        $total = $_POST['total'];
        $orderid = $_POST['orderid'];
        $delivery=$_POST['delivery'];
        $receive=$_POST['receive'];
        $phone=$_POST['phone'];
        $this->om->removeorder($orderid,'form');
        return $this->em-> newcheck($name,$payment,$total,$orderid,$delivery,$receive,$phone);
        


    }
   public function getcheckrecord(){
       return $this->em->getcheckrecord();
   }
}

?>