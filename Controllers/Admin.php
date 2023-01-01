<?php
require_once "Connect.php";
require_once 'InitTrait.php';
class Admin extends Connect{
    use InitTrait;

    public $messErrors = [];

##############################################################
########################     login admin              ########
    public function login($request){
        $email = $request['email'];
        $password = $request['password'];
        /********************************************
        *** check inputs empty
        */
        if(empty($email)) $this->messErrors[] = "the input email is empty";
        if(empty($password)) $this->messErrors[] = "the input password is empty";
        /********************************************
        *** check validation inputs
        */
        if(!empty($email) && !empty($password)){
            $sql = "SELECT * FROM `admins` WHERE `email` = '$email'";
            $result = $this->conn->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if($row){
                $hash= $row['password'];
                if (!password_verify($password, $hash)) $this->messErrors[] = 'Invalid password';
            }else{
                $this->messErrors[] = "Invalid email";
            } 
        }

        // #### Check for errors ####
        if(empty($this->messErrors)){
                
                $_SESSION['admin'] = $row['id'];
                $_SESSION['adminName'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                $root_path = $this->getRootPath();
                header("location:$root_path/question.php");
            }else{
                return $this->messErrors;
            }  
    }

###############################################################
########################     display single admin       ########
    public function show($id){
        $sql = "SELECT * FROM  admin WHERE `id` = $id";
        $result = $this->conn->query($sql);
         return $result->fetch(PDO::FETCH_ASSOC);
    }

}