<?php
namespace vendor;

class router 
{
    private $routetable;
    public function __construct(){
        $this->routetable=array();
    }
    public function register($action,$class,$method){
        $arr['class']=$class;
        $arr['method']=$method;
        $this->routetable[$action]=$arr;
        return $this->routetable;
    }
    public function run($action){
        $class=$this->routetable[$action]['class'];
        $method=$this->routetable[$action]['method'];
        $class = "app\controller\\" . $class;
        $controller= new $class();
        $response=$controller->$method();
        return $response;
    }
    
}

?>