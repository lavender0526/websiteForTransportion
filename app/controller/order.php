<?php
namespace app\controller;
use vendor\Controller;
use  app\model\order as OrderModel;
use app\model\existstock as existmodel;
use \DateTime;
use DateTimeZone;

class Order extends Controller
{
    private $om;
    public function __construct() {
        $this->om = new OrderModel();
        $this->em=new existmodel();
    }
    public function getorder() {
        if (isset($_POST['id'])) {
            $id=$_POST['id'];
            return $this->om->getorderlist($id);
        }
        else {
       
            return $this->om->getorders();
        }
    }
    
    public function getorderlist() {
        $orderid = $_POST['orderid'];
        return $this->om->getorderlist($orderid);
    }
    public function neworder() {
        $userid = $_POST['id'];
        $date=new DateTime('',new DateTimeZone('Asia/Taipei'));
        $datestr = $date->format('Y-m-d-H-i-s');
        $response = $this->om->neworder($userid, $datestr);
        if($response['status'] == 200){
            $result['id'] = $response['result'];
            $result['userid'] = $userid;
            $result['date'] = $datestr;
            $response['result'] = $result;
        }
        return $response;
    }
    public function newitem()
    {
        $orderid = $_POST['orderid'];
        $proid = $_POST['proid'];
        $price=$_POST['price'];
        $count = $_POST['count'];
        $this->em->removeexiststock($proid,$count);
        return $this->om->newitem($orderid, $proid,$count,$price);
    }
    public function removeorder()
    {
        $proid = $_POST['proid'];
        $id=$_POST['id'];
        $order=$_POST['order'];
        $count = $_POST['count'];
        $this->em->updateexiststock($proid,$count);

        return $this->om->removeorder($id,$order);
    } 
 }

?>