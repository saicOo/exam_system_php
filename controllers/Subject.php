<?php
require_once "Connect.php";
class Subject extends Connect{
    public $messErrors = [];
    private function getRootPath(){
        $pieces = explode("/", $_SERVER['REQUEST_URI']); 
         return $pieces[1];
           
    }
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
########################     insert Exam for Question       ########
public function storeEQ($request){
    $exam_id = $request['exam_id'];
    $question_id = $request['question_id'];
    if(empty($exam_id)) $this->messErrors[] = "the input exam is empty";
    if(empty($question_id)) $this->messErrors[] = "the input question is empty";
        
    if($this->messErrors) return $this->messErrors;
    $sql = "SELECT * FROM `exam_question` WHERE `question_id` = $question_id AND `exam_id` = $exam_id";
    $checkRow = $this->conn->query($sql);
    if($checkRow->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['error'] = "This question already exists";
        header("Refresh:0");
        exit;
    }
    $insert = "INSERT INTO `exam_question`(`eq_id`, `exam_id`, `question_id`) VALUES (null,'$exam_id','$question_id')";
    $this->conn->exec($insert);
    $_SESSION['success'] = "subject created successfully";
    header("Refresh:0");
    exit;

}
###############################################################
########################     insert Exam for Question random  ########
public function storeEQRand($request){
    
    $exam_id = $request['exam_id'];
    $subject_id = $request['subject_id'];
    if(empty($exam_id)){
        $this->messErrors[] = "the input exam is empty";
        return  $this->messErrors;
    }
    $sql = "SELECT * FROM `questions` WHERE subject_id = $subject_id ORDER BY rand() LIMIT 20";
    $result = $this->conn->query($sql);
    foreach($result as $item){
        $question_id = $item['question_id'];
        $insert = "INSERT INTO `exam_question`(`eq_id`, `exam_id`, `question_id`) VALUES (null,'$exam_id','$question_id')";
        $this->conn->exec($insert);
    }
    $_SESSION['success'] = "subject created successfully";
    header("Refresh:0");
    exit;

}

public function destroy($sub_id){
    $sql = "DELETE FROM subjects WHERE `subject_id` = $sub_id";
    $result = $this->conn->exec($sql);
    $_SESSION['success'] = "subject deleted successfully";
    $root_path = $this->getRootPath();
        header("location:/$root_path/subject.php");
        exit;
    
}
}
