<?php
require_once "Connect.php";
require_once 'InitTrait.php';

class Revision extends Connect{
    use InitTrait;
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
    public function revisionsEmpty($exam_id){
        $sql = "DELETE FROM revisions WHERE `exam_id` = $exam_id";
    $result = $this->conn->exec($sql);
    if(isset($_SESSION['exam_id'])) unset($_SESSION['exam_id']);
        // $sql = "TRUNCATE TABLE revisions";
        // $this->conn->query($sql);
        // $root_path = $this->getRootPath();
        // header("location:$root_path/exam.php");
        // exit;
    }


}
