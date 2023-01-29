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
###################################################################
########################     Save the student's answer      ########
public function satartExam($exam_id){
    if(!$this->resultStudent($exam_id)->fetch(PDO::FETCH_ASSOC)){
    $sql = "SELECT exam_question.question_id AS ques_id FROM `exam_question` JOIN exams ON exams.exam_id = exam_question.exam_id
    JOIN questions ON questions.question_id = exam_question.question_id WHERE exam_question.exam_id = $exam_id";
    $result = $this->conn->query($sql);
    $all_questions = $result->fetchAll(PDO::FETCH_ASSOC);
    if($all_questions){
        foreach ($all_questions as $question) {
            $ques_id = $question['ques_id'];
            $insert = "INSERT INTO `revisions`(`revision_id`, `exam_id`,`question_id`,`answar_option`,`marks`) 
        VALUES (null,$exam_id,$ques_id,null,'0 mark')";
            $this->conn->exec($insert);
        }
    }
    }
}

}
