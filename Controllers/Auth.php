<?php
require_once 'InitTrait.php';
class Auth{
    use InitTrait;
    function __construct(){
        $root_path = $this->getRootPath();
        if(!isset($_SESSION['admin'])){
            header("location:$root_path/exam.php"); 
            exit;
        }
    }
    public function checkAuth(){
        $pieces = explode("/", $_SERVER['REQUEST_URI']); 
        $root_path = '/' . $pieces[1]; // local
        if(isset($_SESSION['admin'])) header("location:$root_path/question.php");
        
    }
}