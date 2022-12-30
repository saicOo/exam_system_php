<?php
require_once "Connect.php";
require_once 'InitTrait.php';

class Exam extends Connect{
    use InitTrait;
    
###############################################################
########################   display exams index of level  ########
    public function display(){
        $sql = "SELECT * FROM `exams` ORDER BY exam_id DESC";
        $result = $this->conn->query($sql);
        return $result;
       
    }
###############################################################
########################     store exam             ########
public function store($request){
    $title=  $request['exam_title'];
    $sub_id=  $request['sub_id'];
    /********************************************
    *** check inputs empty
    */
    if(empty($title)) $this->messErrors[] = "the input title is empty";
    if(empty($sub_id)) $this->messErrors[] = "the input sub_id is empty";
    /********************************************
    *** check inputs length
    */
    if(strlen($title) < 2) $this->messErrors[] = "the name max length char 2";
    if(strlen($title) > 200) $this->messErrors[] = "the address max length char 200";     
        // #### Check for errors ####
        if(empty($this->messErrors)){
            $sql = "INSERT INTO `exams`(`exam_id`, `exam_title`,`subject_id`) 
            VALUES (NULL,'$title',$sub_id)";
            $result = $this->conn->exec($sql);
            $_SESSION['success'] = "The exam has been successfully registered";
            header("Refresh:0");
            exit;
        }else{
            
          return  $this->messErrors;
        }
}
###############################################################
########################     show one row exam      ########
    public function show($subject_id){
        $sql = "SELECT * FROM `exams` WHERE subject_id = $subject_id";
        $result = $this->conn->query($sql);
        return $result;
       
    }
############################################################################
########################     display all Question index of exam      ########
    public function showQuestion($exam_id,$page){
        $sql = "SELECT exam_question.question_id ,exam_question.exam_id,questions.question_title,questions.question_type,questions.answer_option FROM `exam_question` JOIN exams ON exams.exam_id = exam_question.exam_id
        JOIN questions ON questions.question_id = exam_question.question_id WHERE exam_question.exam_id = $exam_id";
        $result = $this->conn->query($sql);
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        $countRow = $row;
        return count($countRow) >= $page ? $row[$page - 1] : $row[0];
    }
###############################################################
######################## display all option index of question  ########
    public function option($question_id){
        $sql = "SELECT * FROM `options` WHERE question_id = $question_id";
        $result = $this->conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

###################################################################
########################     Save the student's answer      ########
    public function saveAnswar($exam_id,$ques_id,$option){
        // check admin if exists
        $check = "SELECT * FROM `revisions` WHERE `exam_id` = $exam_id AND `question_id` = $ques_id";
        $result  = $this->conn->query($check);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        $getQuestion = "SELECT * FROM `questions` WHERE question_id = $ques_id";
            $question = $this->conn->query($getQuestion);
            $answer_option = $question->fetch(PDO::FETCH_ASSOC)['answer_option'];
        $mark = $option === $answer_option ? "1 mark" : "0 mark";
        if(!$row){
            $insert = "INSERT INTO `revisions`(`revision_id`, `exam_id`,`question_id`,`answar_option`,`marks`) 
            VALUES (null,$exam_id,$ques_id,'$option','$mark')";
                $this->conn->exec($insert);
        }else{
            $insert = "UPDATE `revisions` SET `answar_option`='$option',`marks`='$mark' WHERE `exam_id` = $exam_id AND `question_id` = $ques_id";
                $this->conn->exec($insert);
        
        }
    }
###############################################################
########################     next question     ########
    public function saveAnswarNext($exam_id,$page,$ques_id,$option){

        if(isset($option))
        $this->saveAnswar($exam_id,$ques_id,$option);
        ++$page;
        $sql = "SELECT COUNT(exam_id) AS c FROM `exam_question` WHERE exam_id = $exam_id";
        $result = $this->conn->query($sql);
        $countExam = $result->fetch(PDO::FETCH_ASSOC);
        $page = $countExam['c'] >= $page ? $page : 1;
        $root_path = $this->getRootPath();
        header("location:$root_path/start_exam.php?ref=".$exam_id.'&page='.$page);
        exit;
    }
###############################################################
########################     Prev question     ########
    public function saveAnswarPrev($exam_id,$page,$ques_id,$option){

        if(isset($option))
        $this->saveAnswar($exam_id,$ques_id,$option);

        --$page;
        $sql = "SELECT COUNT(exam_id) AS c FROM `exam_question` WHERE exam_id = $exam_id";
        $result = $this->conn->query($sql);
        $countExam = $result->fetch(PDO::FETCH_ASSOC);
        $page = $page != 0 ? $page : $countExam['c'];
        $root_path = $this->getRootPath();
        header("location:$root_path/start_exam.php?ref=".$exam_id.'&page='.$page);
        exit;
    }

    ###############################################################
########################     check option exit     ########
public function checkOption($question_id,$exam_id){
    $sql = "SELECT answar_option FROM `revisions` WHERE question_id = $question_id AND exam_id = $exam_id";
    $row = $this->conn->query($sql);
    $option = $row->fetch(PDO::FETCH_ASSOC);
    $result = isset($option['answar_option']) ? $option['answar_option'] : 5;
    return $result;
}
###############################################################
########################     count question      ########
public function questionCount($exam_id){
    $sql = "SELECT COUNT(exam_id) AS c FROM `exam_question` WHERE exam_id = $exam_id";
    $result = $this->conn->query($sql);
    return $result->fetch(PDO::FETCH_ASSOC);
}
public function destroy($exam_id){
    $sql = "DELETE FROM `exams` WHERE `exam_id` = $exam_id";
    $result = $this->conn->exec($sql);
    $_SESSION['success'] = "exam deleted successfully";
    $root_path = $this->getRootPath();
    header("location:$root_path/exam.php");
    exit;
    
}
public function updateStatusExam($exam_id,$status_value){
    $update_status = "UPDATE `exams` SET `status`= $status_value WHERE `exam_id` = $exam_id";
    $this->conn->exec($update_status);
}
}