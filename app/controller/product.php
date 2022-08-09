<?php

namespace app\Controller;
use vendor\Controller;
use vendor\repeat;
use app\model\product as productmodel;
class product extends Controller
{
    private $em;
    public function __construct() {
        $this->em = new productmodel();
    }
    public function getproduct(){
        
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            return $this->em->getproduct($id);
        } else {
            return $this->em->getproducts();
        }
    }
    public function newproduct(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $cpu = $_POST['cpu'];
        $ram=$_POST['ram'];
        $rom=$_POST['rom'];
        $price=$_POST['price'];
        $repeat=repeat::verify(array('id'=>$id,'name'=>$name),'product');
       
     
        $count=count($repeat);
        if ($count==0) {
           
            return $this->em->newproduct($id,$name,$cpu,$ram,$rom,$price);
        }
        else {
            return self::response(204,"已被使用",$repeat);
        }

       
    }
    public function removeproduct(){
        $id = $_POST['id'];
        
        return $this->em->removeproduct($id);
    }
    public function updateproduct(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $cpu = $_POST['cpu'];
        $ram=$_POST['ram'];
        $rom=$_POST['rom'];
        $price=$_POST['price'];
        return $this->em->updateproduct($name,$cpu,$ram,$rom,$price,$id);
           

    }
    
   
}

?>