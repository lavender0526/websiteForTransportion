<?php
namespace app\Controller;
use vendor\Controller;
use app\model\existstock as existstockmodel;
class existstock extends Controller
{

    public function __construct() {
        $this->em = new existstockmodel();
    }
    public function getexiststock(){
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            return $this->em->getexiststock($id);
        } else {
            return $this->em->getexiststocks();
        }  
    }
 
    public function removeexiststock(){
        $id = $_POST['id'];
        $count=$_POST['count'];

        return $this->em->removeexiststock($id,$count); 
    }
    public function updateexiststock(){
        $id = $_POST['id'];
        $count = $_POST['count'];
        
        return $this->em->updateexiststock($id,$count);
           

    }
    
   
}

?>