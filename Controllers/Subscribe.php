<?php
require_once "Connect.php";

class Subscribe extends Connect{
    public $messErrors = [];
    
###############################################################
########################     display all subjects     ########
public function display(){
        
    $sql = "SELECT * FROM `subscribe`";
    $result = $this->conn->query($sql);
    return $result;
}

###############################################################
########################     insert new subjects       ########
public function store($request){
    $message = $request['message'];
    /********************************************
    *** check inputs empty
    */
    if(empty($message)) $this->messErrors[] = "the input message is empty";
    /********************************************
    *** check inputs length
    */
    if(strlen($message) > 400) $this->messErrors[] = "the message max length char 400";

    $message = filter_var($message,FILTER_SANITIZE_STRING);

    // #### Check for errors ####
    if(empty($this->messErrors)){
    $sql = "INSERT INTO `subscribe`(`id`, `message`) VALUES (null,'$message')";
    $result = $this->conn->exec($sql);
    $_SESSION['success'] = "send message successfully";
    header("Refresh:0");
    exit;
    }else{
        return $this->messErrors;
    }
}


}
