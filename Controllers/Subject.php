<?php
require_once "Connect.php";
require_once 'InitTrait.php';

class Subject extends Connect{

    use InitTrait;

###############################################################
########################     insert new subjects       ########
public function store($request){
    $subject_name = $request['subject_name'];
    /********************************************
    *** check inputs empty
    */
    if(empty($subject_name)) $this->messErrors[] = "the input subject name is empty";
    /********************************************
    *** check inputs length
    */
    if(strlen($subject_name) > 150) $this->messErrors[] = "the name max length char 150";
    /********************************************
    *** check validation inputs
    */
    $check = "SELECT * FROM `subjects` WHERE `subject_name` = '$subject_name'";
    $checkRow  = $this->conn->query($check);
    if($checkRow->fetch(PDO::FETCH_ASSOC)){
        $this->messErrors[] = "This subject already exists";
    }
    // #### Check for errors ####
    if(empty($this->messErrors)){
    $sql = "INSERT INTO `subjects`(`subject_id`, `subject_name`) VALUES (null,'$subject_name')";
    $result = $this->conn->exec($sql);
    $_SESSION['success'] = "subject created successfully";
    header("Refresh:0");
    exit;
    }else{
        return $this->messErrors;
    }
}

###############################################################
########################     display all subjects     ########
public function display(){
        
        $sql = "SELECT * FROM `subjects`";
        $result = $this->conn->query($sql);
        return $result;
    }

###############################################################
########################     delete subject  ########
public function destroy($sub_id){
    $sql = "DELETE FROM subjects WHERE `subject_id` = $sub_id";
    $result = $this->conn->exec($sql);
    $_SESSION['success'] = "subject deleted successfully";
    $root_path = $this->getRootPath();
        header("location:$root_path/subject.php");
        exit;
    
}
}
