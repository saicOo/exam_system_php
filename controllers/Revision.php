<?php
require_once "Connect.php";
class Revision extends Connect{

    private function getRootPath(){
        $pieces = explode("/", $_SERVER['REQUEST_URI']); 
         return $pieces[1];
           
        }
        
###############################################################
########################     display exams of students      ########
    public function totalResult($exam_id){
        $sql = "SELECT exams.exam_title,SUM(revisions.marks) AS mark,COUNT(revisions.question_id) AS total_ques
        FROM `revisions`
        JOIN `exams` ON exams.exam_id = revisions.exam_id 
        WHERE revisions.exam_id = $exam_id";
        $result = $this->conn->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
###############################################################
########################     result exam student      ########
    public function resultStudent($exam_id){
        $sql = "SELECT revisions.marks,revisions.question_id,questions.question_title,revisions.answar_option 
        FROM `revisions` 
        JOIN `questions` ON questions.question_id = revisions.question_id 
        WHERE revisions.exam_id = $exam_id";
        $result = $this->conn->query($sql);
        return $result;
    }
###############################################################
########################     result exam student      ########
    public function revisionsEmpty(){
        $sql = "TRUNCATE TABLE revisions";
        $this->conn->query($sql);
        $root_path = $this->getRootPath();
        header("location:/$root_path/subject.php");
        exit;
    }


}
